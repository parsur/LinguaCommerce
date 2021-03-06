import React from 'react';
import { mainPageData, textSliderData } from '../../Data';
import Hero from '../Landing';

const FirstPage = () => {
    return (
        <>
        <Hero {...mainPageData} data={textSliderData}/>
        </>
    )
}

export default FirstPage
