import React from 'react'
import CourseDetails from '../CourseDetails'
import Footer from '../Footer';
import Navbar from '../Navbar';

const CourseDetailsPage = () => {
  return (
    <>
      <Navbar/>
      <CourseDetails/>
      <Footer style={{background:"#fff"}}/>
    </>
  )
}

export default CourseDetailsPage
