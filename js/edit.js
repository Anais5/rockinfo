function edit(data)
{
    let input = document.createElement('input')
    input.value = data.innerText;

    let valide_img = document.createElement('img')
    valide_img.src = "pics/valide.svg"
    valide_img.width = 25
    valide_img.onclick = null //Add Async traitment

    let cancel_img = document.createElement('img')
    cancel_img.src = "pics/cancel.svg"
    cancel_img.width = 25
    cancel_img.setAttribute('onclick', 'revert(this.parentElement,\'' + data.innerText + '\')')

    data.innerText = null

    data.appendChild(input)
    data.appendChild(valide_img)
    data.appendChild(cancel_img)
}

function revert(data, value)
{
    data.innerText = value

    let edit_img = document.createElement('img')
    edit_img.src = 'pics/edit.png'
    edit_img.setAttribute('onclick', 'edit(this.parentElement)')
    edit_img.width = 25

    data.appendChild(edit_img)
}
