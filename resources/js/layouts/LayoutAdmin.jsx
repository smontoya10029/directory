import React, { useEffect } from 'react'
import Navbar from '../components/Navbar'
import Footer from '../components/footer'
import { Outlet, useNavigate } from 'react-router-dom'
import AuthUser from '../pageauth/AuthUser'

const LayoutAdmin = () => {

    const { getRol } = AuthUser()
    const navigate = useNavigate

    useEffect(()=>{
        if(getRol() != "admin"){
            navigate("/")
        }
    },[])

    return (

        <div>
            <h1>ADMIN</h1>
            <Navbar/>
            <Outlet/>
            <Footer/>
        </div>

    )
}

export default LayoutAdmin
