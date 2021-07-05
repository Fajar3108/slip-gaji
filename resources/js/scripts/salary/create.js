import $ from '../utils/QuerySelectorHelper.js';


// GET INPUT ELEMENTS
const getInputElmnts = () => {
  const elmnts  = new Map();
  const query   = '#input-form input:not([type="hidden"])';

  $.all(query).forEach((item) => elmnts.set(item.id, item));

  return elmnts;
};


// GET PREVIEW ELEMENTS
const getPreviewElmnts = () => {
  const elmnts  = new Map();
  const query   = '#preview-box td[id], #preview-box th[id]';

  $.all(query).forEach((item) => elmnts.set(item.id, item));

  return elmnts;
};


// GET INPUT VALUES
const getInputValues = () => {
  const values      = new Map();
  const inputElmnts = getInputElmnts();

  for(const [key, item] of inputElmnts) {
    values.set(key, item.value);
  }

  return values;
};


const getIncomeIdList = () => {
  return new Set([
    'gajiPokok',
    'tunjanganJabatan',
    'tunjanganKinerja',
    'tunjanganProject',
    'kehadiran',
    'lembur',
    'jaminanKecelakaanKerja',
    'jaminanKematian',
    'jaminanHariTua',
    'jaminanPensiun'
  ])
};

const getOutgoIdList = () => {
  return new Set([
    'bpjsTKPerusahaan',
    'jaminanPensiunPotongan',
    'jaminanHariTuaPotongan',
    'BPJSDitanggungPerusahaan',
    'BPJSDitanggungKaryawan',
    'pinjamanKaryawan',
    'pph'
  ]);
}


// GET CALCULATED PREVIEWS VALUES
const getCalculatedValues = () => {
  const values          = new Map();
  const inputValues     = getInputValues();
  const incomeIdList    = getIncomeIdList();
  const outgoIdList     = getOutgoIdList();
  const pensiunLimit    = 8754600;
  const kesehatanLimit  = 12000000;

  values.set('gajiPokok', Number(inputValues.get('gaji_pokok')));
  values.set('tunjanganJabatan', Number(inputValues.get('tunjangan_jabatan')));
  values.set('tunjanganKinerja', Number(inputValues.get('tunjangan_kinerja')));
  values.set('tunjanganProject', Number(inputValues.get('tunjangan_project')));
  values.set('kehadiran', Number(inputValues.get('kehadiran_input')));
  values.set('lembur', Number(inputValues.get('lembur_input')));
  values.set('pinjamanKaryawan', Number(inputValues.get('pinjaman_karyawan')));
  values.set('pph', Number(inputValues.get('pph_input')));

  const mainSalary = (
    values.get('gajiPokok') + 
    values.get('tunjanganJabatan') + 
    values.get('tunjanganKinerja')
  );

  values.set('jaminanKecelakaanKerja',    (0.24/100) * mainSalary);
  values.set('jaminanKematian',           (0.30/100) * mainSalary);
  values.set('jaminanHariTua',            (3.7/100) * mainSalary);
  values.set('jaminanPensiun',            (2/100) * Math.min(mainSalary, pensiunLimit));
  values.set('jaminanPensiunPotongan',    (1/100) * Math.min(mainSalary, pensiunLimit));
  values.set('jaminanHariTuaPotongan',    (2/100) * mainSalary);
  values.set('BPJSDitanggungPerusahaan',  (4/100) * Math.min(mainSalary, kesehatanLimit));
  values.set('BPJSDitanggungKaryawan',    (1/100) * Math.min(mainSalary, kesehatanLimit));

  const bpjsTK = (
    values.get('jaminanKecelakaanKerja') + 
    values.get('jaminanKematian') +
    values.get('jaminanHariTua') +
    values.get('jaminanPensiun')
  );

  values.set('bpjsTKPerusahaan', bpjsTK);

  const idList = new Set([incomeIdList, outgoIdList]);
  const total = new Map([
    ['income', 0],
    ['outgo', 0]
  ]);

  idList.forEach(listItem => {
    listItem.forEach(item => {
      const income = total.get('income');
      const value  = values.get(item);
      total.set('income', income + value);
    });
  });

  total.set('salary', total.get('income') - total.get('outgo'));
  values.set('jumlahGaji', total.get('salary'));
  
  return values;
};


// CONVERT TO INDONESIAN CURRENCY FORMAT
const toIDR = (number) => {
  return Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 2,
    maximumFractionDigits: 2,
  }).format(number);
};


// UPDATE PREVIEW ELEMENTS
const updatePreview = () => {
  const previews = getPreviewElmnts();
  const values   = getCalculatedValues();
  
  for(const [key, value] of values.entries()) {
    previews.get(key).innerText = toIDR(value);
  }
};


// INITIALIZE
updatePreview();
for(const item of getInputElmnts()) {
  item[1].addEventListener('input', updatePreview);
};
