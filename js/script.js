function PontosMaxMin(x){
    x.value = parseInt(x.value);

    if(x.value < 0){
        x.value *= -1;
    }
    else if(x.value > 10){
        x.value = 10;
    }
}

function Top(x){
    hide = document.getElementById('hide');
    hide.id = 'rank';
    x.parentElement.id = 'hide'
}