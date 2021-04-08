import React from 'react'
import ArticleDetails from '../ArticleDetails';
import Footer from '../Footer';
import Navbar from '../Navbar';

const CourseDetailsPage = () => {
  return (
    <>
      <Navbar/>
      <ArticleDetails/>
      <Footer style={{background:"#fff"}}/>
    </>
  )
}

export default CourseDetailsPage
