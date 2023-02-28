import React from 'react';
import Card from './Card';
import { adPhone, headphone } from '../../../assets';

const AllProducts = () => {
  return (
    <section>
      <h1 className='font-clash600 text-[32px] leading-[39px] mb-[48px]'>
        Recommended For You
      </h1>
      <div className=' grid grid-flow-row grid-cols-4 grid-rows-3 gap-x-[30px] gap-y-[50px]'>
        <Card
          image={headphone}
          heading={'JBL T450 Headphone'}
          description={'JBL T450 Headphones Wireless Audio'}
          price={'$24.95'}
        />
        <Card
          image={headphone}
          heading={'JBL T450 Headphone'}
          description={'JBL T450 Headphones Wireless Audio'}
          price={'$24.95'}
        />
        <Card
          image={headphone}
          heading={'JBL T450 Headphone'}
          description={'JBL T450 Headphones Wireless Audio'}
          price={'$24.95'}
        />
        <div className=' row-span-4 relative'>
          <img className=' object-cover absolute bottom-0' src={adPhone} />
        </div>
        <Card
          image={headphone}
          heading={'JBL T450 Headphone'}
          description={'JBL T450 Headphones Wireless Audio'}
          price={'$24.95'}
        />
        <Card
          image={headphone}
          heading={'JBL T450 Headphone'}
          description={'JBL T450 Headphones Wireless Audio'}
          price={'$24.95'}
        />
        <Card
          image={headphone}
          heading={'JBL T450 Headphone'}
          description={'JBL T450 Headphones Wireless Audio'}
          price={'$24.95'}
        />
        <Card
          image={headphone}
          heading={'JBL T450 Headphone'}
          description={'JBL T450 Headphones Wireless Audio'}
          price={'$24.95'}
        />
        <Card
          image={headphone}
          heading={'JBL T450 Headphone'}
          description={'JBL T450 Headphones Wireless Audio'}
          price={'$24.95'}
        />
        <Card
          image={headphone}
          heading={'JBL T450 Headphone'}
          description={'JBL T450 Headphones Wireless Audio'}
          price={'$24.95'}
        />
      </div>
    </section>
  );
};

export default AllProducts;
