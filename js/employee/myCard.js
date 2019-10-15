const cards = document.getElementsByClassName('myCard');
console.log(cards);
Array.from(cards).forEach(element => {
    const a_node = createMyCardBtns(element);
    a_node.setAttribute('onclick', 'onCardClick(this)')
});

function createMyCardBtns(element) {
    const node = document.createElement('div');
    node.className = 'myCard-btns';
    const a_node = document.createElement('a');
    const arrow_pos = element.className == 'myCard' ? '▲' : '▼';
    if (element.className == 'myCard') {
        element.children[1].style.display = 'block';
    }
    const text_node = document.createTextNode(arrow_pos);
    a_node.appendChild(text_node);
    node.appendChild(a_node);
    element.prepend(node);
    return a_node;
}

function onCardClick(elem) {
    const my_card = elem.parentElement.parentElement;
    const card_body = my_card.children[2];
    if (my_card.className == 'myCard') {
        my_card.classList.add('card-hide');
        elem.innerText = '▼';
        card_body.style.display = 'none';
    } else {
        my_card.classList.remove('card-hide');
        elem.innerText = '▲';
        card_body.style.display = 'block';
    }
}