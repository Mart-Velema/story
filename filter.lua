function Header(element)
    if element.level == 1
    then
        local hr = pandoc.RawBlock('html', '<hr>')
        return {hr, element}
    else
        return element
    end
end