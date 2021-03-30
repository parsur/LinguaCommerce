import React, { useState, useEffect } from 'react';

function App() {

  const [categories, setCategories] = useState([]);

  useEffect(() => {
    // here is fetch id. change it if you want
    fetch("/home")
    .then(res => res.json())
    .then((data) => {
    console.log(data);
    })
  }, []);

  const list = categories.map((name, id, i) => {
    console.log(name)
    return <p key={i}>name: {name} id: {id} </p>
  })

  return categories ? (
    <>
    <div>content is loaded</div>
    <hr/>
    {list}
    </>
  ) : (
    <div>Loading...</div>
  );

}; 
export default App;