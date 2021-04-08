import React from 'react';
import Footer from '../Footer';
import Navbar from'../Navbar';
import Article from '../Article';
import { courseData } from '../../Data';

const CourseListPage = () => {
    return (
        <>
        <Navbar />
        <Article data={courseData} />
        <Footer style={{background:"#fff"}} />
        </>
    )
}

export default CourseListPage;