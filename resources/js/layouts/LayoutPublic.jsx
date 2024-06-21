import React from 'react'
import Navbar from '../components/Navbar'
import Footer from '../components/footer'
import { Outlet } from 'react-router-dom'

const LayoutPublic = () => {
  return (

    <>
        <h1>PUBLIC</h1>
        <Navbar/>
        <Outlet/>
        <Footer/>
    </>

  )
}

export default LayoutPublic
