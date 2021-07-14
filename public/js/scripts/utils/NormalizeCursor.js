class NormalizeCursor{
  constructor(elmnt) {
    this._elmnt          = elmnt;
    this._value          = elmnt.value;
    this._selectionStart = elmnt.selectionStart;
    return this;
  }


  normalize() {
    console.log(this._selectionStart);
    console.log(this._elmnt.selectionStart);
  }
};

export default NormalizeCursor;