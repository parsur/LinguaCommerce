import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
import FirstPage from './components/Pages/FirstPage';
import GlobalStyle from './globalStyles';
import CourseListPage from './components/Pages/CourseListPage';
import AboutUsPage from './components/Pages/AboutUsPage';
import UserPage from './components/Pages/UserPage';
import Consultante from './components/Pages/Consultante';
import WhymePage from './components/Pages/WhymePage';

function App() {

  /* const [categories, setCategories] = useState([]);

  useEffect(() => {
    // here is fetch id. change it if you want
    fetch("http://sararajabi.com/home")
    .then(res => res.json())
    .then((data) => {
      setCategories(data.subCategories);
    })
  }, []);

  const list = categories.map(({name, id, i}) => {
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
  ); */
/*  const [todos, setTodos] = useState();
  const [nextTodoId, setNextTodoId] = useState(0);
  const [newTodoLabel, setNewTodoLabel] = useState("");

  useEffect(() => {
    axios
      .get(
        "https://gist.githubusercontent.com/witalewski/fc8f043d53a0d505f84c5ddb04ae76ea/raw/7c505bbc1675a0bc8a067f8b633b531c769bb64c/data.json"
      )
      .then(({ data }) => {
        setTodos(data);
        setNextTodoId(data.length);
      });
  }, []);

  const markTodoAsDone = (id, done) =>
    setTodos(todos.map(todo => (todo.id === id ? { ...todo, done } : todo)));

  const removeTodo = id => setTodos(todos.filter(todo => todo.id !== id));

  const addNewTodo = () => {
    setTodos([
      ...todos,
      {
        id: nextTodoId,
        label: newTodoLabel,
        done: false
      }
    ]);
    setNextTodoId(nextTodoId + 1);
    setNewTodoLabel("");
  };

  return todos ? (
    <div className="todo-list">
      <ul>
        {todos.map(todo => (
          <li key={todo.id}>
            <input
              type="checkbox"
              checked={todo.done}
              onChange={({ target }) => markTodoAsDone(todo.id, target.checked)}
              label={todo.label}
            />
            <span className={todo.done ? "done" : ""}>{todo.label}</span>
            <button onClick={() => removeTodo(todo.id)}>X</button>
          </li>
        ))}
      </ul>
      <div className="new-todo">
        <input
          type="text"
          value={newTodoLabel}
          onChange={({ target }) => setNewTodoLabel(target.value)}
        />
        <button onClick={addNewTodo}>Add</button>
      </div>
    </div>
  ) : (
    <div>Loading...</div>
  ); */


    return(
    <>
 <GlobalStyle />
      <Router>
        <Switch>
          <Route path='/' exact component={FirstPage}/>
          <Route path='/courselist' exact component={CourseListPage}/>
          <Route path='/aboutus' exact component={AboutUsPage}/>
          <Route path='/userpage' exact component={UserPage}/>
          <Route path='/consultante' exact component={Consultante}/>
          <Route path='/whyme' exact component={WhymePage}/>
        </Switch>
      </Router>
    </>
    );
}; 
export default App;