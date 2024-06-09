function copyCodeToClipboard()
{
    let documentCode = document.getElementById('document-code');
    navigator.clipboard.writeText(documentCode.value);
    alert("Copied " + documentCode.textContent + " to the clipboard");
}