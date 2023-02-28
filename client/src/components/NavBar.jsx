import React from 'react';
import Search from './Search';
import { favIcon, cartIcon, accountIcon } from '../assets';
import { Link } from 'react-router-dom';

const NavBar = () => {
  return (
    <nav className=' flex  justify-between'>
      <h1 className=' font-clash600 text-font1 text-[32px] leading-[39px]'>
        GGT.Mart
      </h1>
      <Search />
      <div className=' flex gap-[28px] items-center justify-center'>
        <img src={favIcon} alt='fav' />
        <Link to='/sign-in'>
          <img src={accountIcon} alt='profile' />
        </Link>
        <img src={cartIcon} alt='cart' />
      </div>
    </nav>
  );
};

export default NavBar;
