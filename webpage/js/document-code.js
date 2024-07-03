function copyCodeToClipboard()
{
    let documentCode = document.getElementById('document-code');
    let text = documentCode.textContent || documentCode.innerText;
    navigator.clipboard.writeText(text);
    alert("Copied " + documentCode.textContent + " to the clipboard");
}