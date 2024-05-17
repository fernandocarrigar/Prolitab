function valSel(x, val) {
    const select = document.getElementById(x);
    if (select != null) {
        // const valor = select.value;
        const selectnew = select.children;

        for (k = 0; k < selectnew.length; k++) {
            if (selectnew[k].value == val) {
                selectnew[k].setAttribute("selected", "");
            } else {
                selectnew[k].removeAttribute("selected");
            }
        }
    }
}