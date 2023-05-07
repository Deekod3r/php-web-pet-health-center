function checkSpecialCharacter(character) {
    var format = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    var formatPassword = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    format.test("");
}

function confirmAction(action,object) {
    return confirm("Bạn có muốn " + action + " " + object + " " + "không?");
}