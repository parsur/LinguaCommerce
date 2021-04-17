import React from 'react';
import Footer from '../Footer';
import Navbar from'../Navbar';
import Course from '../Course';
import { courseData } from '../../Data';

const CourseListPage = () => {
    return (
        <>
        <Navbar />
        <Course data={courseData} />
        <Footer style={{background:"#eee"}} />
        </>
    )
}

export default CourseListPage;