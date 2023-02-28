import React from 'react';
import { Routes, Route } from 'react-router-dom';
import { Home, Register, SignIn } from './pages';
import { GoogleOAuthProvider } from '@react-oauth/google';

const App = () => {
  const clientId = import.meta.env.VITE_GOOGLE_CLIENT_ID;
  return (
    <div className=' w-full overflow-hidden px-[1rem] lg:px-[3rem] xl:px-[8rem] mt-8'>
      <Routes>
        <Route exact path='/' element={<Home />} />
        <Route exact path='/sign-in' element={<SignIn />} />
        <Route exact path='/register' element={<Register />} />
      </Routes>
    </div>
  );
};

export default App;
