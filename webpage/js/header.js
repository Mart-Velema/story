function hideHeader()
{
    let root = document.querySelector(':root');
    let header = document.getElementById("header");
    if(header.style.display === "none")
    {
        header.style.display = "grid";
        root.style.setProperty('--header-height', '50px');
    }
    else
    {
        header.style.display = "none";
        root.style.setProperty('--header-height', '0px');
    }
}