const root = document.documentElement
const dropdownTitleIcon = document.querySelector('.dropdown-title-icon')
const dropdownTitle = document.querySelector('.dropdown-title')
const dropdownList = document.querySelector('.dropdown-list')
const mainButton = document.querySelector('.main-button')
const floatingIcon = document.querySelector('.floating-icon')

const listItems = [
  'Bílý čaj',
  'Bylinný čaj',
  'Černý čaj',
  'Ovocný čaj',
  'Zelený čaj',
]

const iconTemplate = (path) => {
  return `
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
      <path d="${path}" />
    </svg>
  `
}

const listItemTemplate = (text, translateValue) => {
  return `
    <li class="dropdown-list-item z1000">
      <button class="dropdown-button list-button" data-translate-value="${translateValue}%">
        <span class="text-truncate">${text}</span>
      </button>
    </li>
  `
}

const renderListItems = () => {
  dropdownList.innerHTML += listItems
    .map((item, index) => {
      return listItemTemplate(item, 100 * index)
    })
    .join('')
}

window.addEventListener('load', () => {
  renderListItems()
})

const setDropdownProps = (deg, ht, opacity) => {
  root.style.setProperty('--rotate-arrow', deg !== 0 ? deg + 'deg' : 0)
  root.style.setProperty('--dropdown-height', ht !== 0 ? ht + 'rem' : 0)
  root.style.setProperty('--list-opacity', opacity)
}

mainButton.addEventListener('click', () => {
  const listWrapperSizes = 3.5 // margins, paddings & borders
  const dropdownOpenHeight = 4.6 * listItems.length + listWrapperSizes
  const currDropdownHeight =
    root.style.getPropertyValue('--dropdown-height') || '0'

  currDropdownHeight === '0'
    ? setDropdownProps(180, dropdownOpenHeight, 1)
    : setDropdownProps(0, 0, 0)
})

dropdownList.addEventListener('mouseover', (e) => {
  const translateValue = e.target.dataset.translateValue
  root.style.setProperty('--translate-value', translateValue)
})

dropdownList.addEventListener('click', (e) => {
  const clickedItemText = e.target.innerText.toLowerCase().trim()
  const clickedItemIcon = icons[clickedItemText]

  dropdownTitleIcon.innerHTML = iconTemplate(clickedItemIcon)
  dropdownTitle.innerHTML = clickedItemText
  setDropdownProps(0, 0, 0)
})
