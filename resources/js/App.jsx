import React from 'react'
import { createRoot } from 'react-dom/client';
import 'bootstrap/dist/css/bootstrap.min.css'

//PUBLIC
import PageHome from './pagepublic/PageHome';
import ProtectedRoutes from './pageauth/ProtectedRoutes';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';

//LAYOUT
import LayoutPublic from './layouts/LayoutPublic';
import LayoutAdmin from './layouts/LayoutAdmin';
import LayoutClient from './layouts/LayoutClient';

//AUTH
import Login from './pageauth/Login';
import Register from './pageauth/Register';
import PanelAdmin from './pageadmin/PanelAdmin';
import PanelClient from './pageclient/PanelClient';

const App = () => {
  return (
    <Router>
        <Routes>

            <Route path="/" element={<LayoutPublic/>}>
                <Route index element={<PageHome/>} />
                <Route path='/Login' element={<Login/>}/>
                <Route path='/register' element={<Register/>}/>
            </Route>

            <Route element={<ProtectedRoutes/>}>

                <Route path="/admin" element={<LayoutAdmin/>}>
                    <Route index element={<PanelAdmin/>} />
                </Route>

                <Route path="/client" element={<LayoutClient/>}>
                    <Route index element={<PanelClient/>} />
                </Route>

            </Route>
        </Routes>
    </Router>
  )
}

export default App

if (document.getElementById('root')) {
    const Index = createRoot(document.getElementById("root"));

    Index.render(
        <React.StrictMode>
            <App/>
        </React.StrictMode>
    )
}
