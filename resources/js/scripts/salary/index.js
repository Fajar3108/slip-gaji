import $ from '../utils/QuerySelectorHelper.js';

// GET ALL BUTTON ELEMENTS
const getButtonElmnts = () => {
  return new Map([
    ['massDelete', $.first('#massDelete')]
  ]);
};


// GET DELETE CHECKBOX ELEMENTS
const getDeleteCheckboxElmnts = () => {
  const slectAllCheckbox  = $.first('#selectAll');
  const checkboxes        = new Set($.all('.check-id'));

  return new Map([
    ['selectAllCheckbox', slectAllCheckbox],
    ['checkboxes', checkboxes]
  ]);
};


// GET CHECKED DELETE CHECKBOXES
const getDeleteCheckboxCheckedId = () => {
  const checkboxes = getDeleteCheckboxElmnts().get('checkboxes');
  const result     = new Set();

  checkboxes.forEach(item => {
    if(item.checked) result.add(item.dataset.id);
  });

  return result;
};


// VALIDATION HAVE A CHECKED CHECKBOX
const haveAChecked = (checkboxes) => {
  const elmnts = [...checkboxes];
  return elmnts.some(elmnt => elmnt.checked);
};


// VALIDATION OF ALL CHECKBOXES CHECKED
const isAllDeleteCheckboxChecked = () => {
  const checkboxes = [...getDeleteCheckboxElmnts().get('checkboxes')];
  return checkboxes.every(item => item.checked);
};


// ACTIVE MASS DELETE BUTTON
const activateDeleteButton = () => {
  const deleteButton  = getButtonElmnts().get('massDelete');
  deleteButton.classList.remove('disabled');
}


// DISABLE MASS DELETE BUTTON
const disableDeleteButton = () => {
  const deleteButton  = getButtonElmnts().get('massDelete');
  deleteButton.classList.remove('disabled');
  deleteButton.classList.add('disabled');
}


// REQUEST TO ACTIVE MASS DELETE BUTTON
const requestActivateDeleteButton = () => {
  const checkboxes    = getDeleteCheckboxElmnts().get('checkboxes');

  if(haveAChecked(checkboxes)) {
    activateDeleteButton();
    return true;
  }

  disableDeleteButton();
  return false;
};


// MASS DELETE BUTTON CLICK HANDLER
const massDeleteButtonClickHandler = async (event) => {
  const checkedId = [...getDeleteCheckboxCheckedId()];
  const confirm   = window.confirm('Are you sure?');

  if(!confirm) return;

  try {
    const endpoint  = `/api/salary`;
    const request   = new Request(endpoint, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        'Allow-Access-Control-Credentials': true,
        'Accept': 'application/json'
      },
      body: JSON.stringify({ "ids": checkedId })
    });
    const response  = await fetch(request);
    const resJson   = await response.json();
    
    if(response.status !== 200) throw 'Failed';

    checkedId.forEach(id => $.first(`#salary-${id}`).remove());
    
  } catch(err) {
    console.log(err);
  }
};


// SELECT ALL DELETE CHECKBOX CLICK HANDLER
const selectAllDeleteCheckboxClickHandler = (event) => {
  const { target }  = event;
  const checkboxes  = getDeleteCheckboxElmnts().get('checkboxes');
  const itemChecked = target.checked ? true : false;
  
  checkboxes.forEach(item => item.checked = itemChecked);
  requestActivateDeleteButton();
}


// DELETE CHECKBOX CLICK HANDLER
const deleteCheckboxClickHandler = (event) => {
  const selectAllCheckbox = getDeleteCheckboxElmnts().get('selectAllCheckbox');

  if(isAllDeleteCheckboxChecked()) selectAllCheckbox.checked = true;
  else selectAllCheckbox.checked = false;

  requestActivateDeleteButton();
};


// INITIALIZE
const massDeleteButton  = getButtonElmnts().get('massDelete');
const selectAllCheckbox = getDeleteCheckboxElmnts().get('selectAllCheckbox');
const deleteCheckboxes  = getDeleteCheckboxElmnts().get('checkboxes');

massDeleteButton.addEventListener('click', massDeleteButtonClickHandler);
selectAllCheckbox.addEventListener('click', selectAllDeleteCheckboxClickHandler);
deleteCheckboxes.forEach(item => {
  item.addEventListener('click', deleteCheckboxClickHandler);
});