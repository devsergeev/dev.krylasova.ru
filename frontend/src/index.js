import './style.css'
import printMe from './print.js';

if (process.env.NODE_ENV === 'development') {
  console.warn('Is dev mode');
}

const component = (itemText) => {
  const element = document.createElement('div')
  element.innerHTML = itemText
  element.classList.add('item')
  element.classList.add('icon')
  element.onclick = printMe(() => {
    const element = document.createElement('div')
    element.innerHTML = itemText
    document.body.appendChild(element)
  })
  return element
}

const createNewElement = (title = 'New Item') => {
  document.body.appendChild(component(title))
}

createNewElement('Hello, webpack!')
createNewElement('My Blog')
