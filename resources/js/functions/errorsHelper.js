function removeErrorStringExtraSymbols(text)
{   
    if(text)
    {   
        let newText = text.toString();
        newText.replace('[', '');
        newText.replace(']', '');
        return newText;
    }
    return '';
}

export default { removeErrorStringExtraSymbols }