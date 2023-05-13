import React from 'react'
import variables from '../variables.module.sass'
import './_navbar.scss'
type Props = {}

export default function Navbar({}: Props) {
  return (
    <div style={{backgroundColor: variables.primaryColor}} className='navbar navbar-brand'>Stravinsky</div>
  )
}
