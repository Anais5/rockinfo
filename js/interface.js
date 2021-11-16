function switch_log()
{
    let form_connexion = document.getElementById("connexion")
    let form_inscription = document.getElementById("inscription")

    form_connexion.hidden = !form_connexion.hidden
    form_inscription.hidden = !form_inscription.hidden
}
