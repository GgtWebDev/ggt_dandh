import { useState } from 'react';
import reactLogo from './assets/react.svg';
import './App.css';

function App() {
  const [count, setCount] = useState(0);

  const accountInfo = {
    grant_type: 'client_credentials',
    client_id: '844dd702-7b17-4cd2-bca6-9398d0ceaef7',
    client_secret: 'c29d74b1-cc74-466f-bb81-e0a595baebc9',
    scope: '',
  };

  let formBody = [];

  for (let property in accountInfo) {
    let encodedKey = encodeURIComponent(property);
    let encodedValue = encodeURIComponent(accountInfo[property]);
    formBody.push(encodedKey + '=' + encodedValue);
  }

  formBody = formBody.join('&');

  const createAccount = async () => {
    const response = await fetch(
      `https://test.auth.dandh.com/api/oauth/token`,
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
        },
        body: formBody,
      }
    );
    const data = await response.json();
    console.log(data);
  };

  return (
    <div className='App'>
      <div>
        <a href='https://vitejs.dev' target='_blank'>
          <img src='/vite.svg' className='logo' alt='Vite logo' />
        </a>
        <a href='https://reactjs.org' target='_blank'>
          <img src={reactLogo} className='logo react' alt='React logo' />
        </a>
      </div>
      <h1>Vite + React</h1>
      <div className='card'>
        <button onClick={createAccount}>count is {count}</button>
        <p>
          Edit <code>src/App.jsx</code> and save to test HMR
        </p>
      </div>
      <p className='read-the-docs'>
        Click on the Vite and React logos to learn more
      </p>
    </div>
  );
}

export default App;
