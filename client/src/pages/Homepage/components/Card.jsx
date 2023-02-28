import React from 'react';
import { cartIcon } from '../../../assets';

const Card = ({ image, heading, description, price, background }) => {
  return (
    <div
      className={`relative flex flex-col w-[277px] h-[auto] rounded-[10px] px-4 pt-4 pb-4 ${
        background ? ' bg-[#F5F5F5]' : 'bg-green3'
      } `}
    >
      <h1 className=' font-clash600 text-[20px] leading-[30px]'>{heading}</h1>
      <div className=' h-[108px] flex items-end mt-[12px]'>
        <div className=' flex flex-col gap-4'>
          <p className=' w-[115px] text-[11px] leading-[14px]'>{description}</p>

          <h1 className='font-clash600 text-[24px] leading-[30px]'>{price}</h1>
        </div>
        <div className=' flex'>
          <img src={image} width={107} height={100} />
        </div>
        <div className='absolute bottom-[18px] text-whiteBg right-4 cursor-pointer'>
          <img
            className='ml-2'
            src={cartIcon}
            width={20}
            height={20}
            alt='fav'
          />
        </div>
      </div>
    </div>
  );
};

export default Card;
