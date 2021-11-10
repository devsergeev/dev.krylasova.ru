import './style.css'
import printMe from './print.js';

const component = (itemText) => {
  const element = document.createElement('div')
  element.innerHTML = itemText
  element.classList.add('item')
  element.classList.add('icon')
  element.onclick = printMe(() => createNewElement(itemText))
  return element
}

const createNewElement = (title = 'New Item') => {
  document.body.appendChild(component(title))
}

createNewElement('Hello, webpack!')
createNewElement('My Blog')
