import React from 'react';
import { mainPageData } from '../../Data';
import Hero from '../Landing';

const FirstPage = () => {
    return (
        <>
        <Hero {...mainPageData}/>
        </>
    )
}

export default FirstPage
