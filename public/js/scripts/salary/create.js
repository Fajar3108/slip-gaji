import $ from '../utils/QuerySelectorHelper.js';
import Currency from '../utils/CurrencyHelper.js';


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
    const value = Currency.toNumber(item.value, {decimalSign: ','});
    values.set(key, value);
  }

  return values;
};


// GET ID LIST OF INCOME PREVIEW
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
    'jaminanPensiun',
    'bpjsKesehatan'
  ])
};


// GET ID LIST OF OUTGO PREVIEW
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

  values.set('gajiPokok',        Number(inputValues.get('gaji_pokok')));
  values.set('tunjanganJabatan', Number(inputValues.get('tunjangan_jabatan')));
  values.set('tunjanganKinerja', Number(inputValues.get('tunjangan_kinerja')));
  values.set('tunjanganProject', Number(inputValues.get('tunjangan_project')));
  values.set('kehadiran',        Number(inputValues.get('kehadiran_input')));
  values.set('lembur',           Number(inputValues.get('lembur_input')));
  values.set('pinjamanKaryawan', Number(inputValues.get('pinjaman_karyawan')));
  values.set('pph',              Number(inputValues.get('pph_input')));

  const mainSalary = (
    values.get('gajiPokok') +
    values.get('tunjanganJabatan') +
    values.get('tunjanganKinerja')
  );

  values.set('jaminanKecelakaanKerja',    (0.24/100) * mainSalary);
  values.set('jaminanKematian',           (0.30/100) * mainSalary);
  values.set('jaminanHariTua',            (3.7/100) * mainSalary);
  values.set('jaminanPensiun',            (2/100) * Math.min(mainSalary, pensiunLimit));
  values.set('bpjsKesehatan',             (4/100) * Math.min(mainSalary, kesehatanLimit));
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

  const idList = new Map([
    ['income', incomeIdList],
    ['outgo', outgoIdList]
  ]);

  const total = new Map([
    ['income', 0],
    ['outgo', 0]
  ]);

  idList.forEach((listItem, keyList) => {
    listItem.forEach(item => {
      total.set(keyList, total.get(keyList) + values.get(item));
    });
  });

  total.set('salary', total.get('income') - total.get('outgo'));
  values.set('jumlahGaji', total.get('salary'));

  return values;
};


// VALUE INPUT ELEMENT TO CURRENCY FORMAT
const valueToCurrencyHandler = (event) => {
  const { target, type }  = event;
  const { value }         = target;
  const locales           = 'id-ID';
  const decimalSign       = ',';
  
  if(event.data === ',' && value[value.length-1] === ',') return;
  if(type === 'focus') {
    const currencyValue = Currency.fromNumber(value, {locales});
    return target.value = currencyValue;
  }
  
  const { selectionStart, selectionEnd } = target;
  const validated           = value.replace(/[^0-9\.\,]/, '');
  const numberValue         = Currency.toNumber(validated, {decimalSign});
  const currencyValue       = Currency.fromNumber(numberValue, {locales});
  
  target.value = currencyValue;
  
  if(selectionEnd === value.length) return;
  const diffValidatedLength = currencyValue.length - validated.length;
  const cursorStart         = selectionStart + diffValidatedLength;
  const valueInFront        = currencyValue.slice(0, cursorStart);
  const diffValueLength     = valueInFront.length - currencyValue.length;
  const range               = currencyValue.length + diffValueLength;

  target.setSelectionRange(range, range);
}


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


// CURRENCY INPUT EVENT HANDLER
const currencyInputHandler = (event) => {
  valueToCurrencyHandler(event);
  updatePreview();
};


// INITIALIZE
updatePreview();
for(const [key, item] of getInputElmnts()) {
  if(item.classList.contains('currency-input')) {
    item.addEventListener('input', currencyInputHandler);
    item.addEventListener('focus', currencyInputHandler);
    item.addEventListener('blur', (event) => {
      const { target } = event;
      target.value = Currency.toNumber(target.value, {decimalSign: ','});
    })
  }

  item.addEventListener('input', updatePreview);
};