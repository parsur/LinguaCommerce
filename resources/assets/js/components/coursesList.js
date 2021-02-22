import axios from 'axios'
import React, { Component } from 'react'
import { Link } from 'react-router-dom'

class coursesList extends Component {
  constructor () {
    super()

    this.state = {
      courses: []
    }
  }

  componentDidMount () {
    axios.get('home').then(response => {
      this.setState({
        courses: response.data.courses,
      })
    })
  }

  render () {
    const { courses } = this.state

    return (
      <div className='container py-4'>
        <div className='row justify-content-center'>
          <div className='col-md-8'>
            <div className='card'>
              <div className='card-header'>All courses</div>
              <div className='card-body'>
               
                <ul className='list-group list-group-flush'>
                  {courses.map(course => 
                    <div key={course.id}>{course.name}</div>
                  )}
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    )
  }
}

export default coursesList
