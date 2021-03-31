import React, { useEffect, useState } from 'react';
import {
    Container,
    Left,
    Right,
    Top,
    Bottom,
    Img,
    H1,
    P,
    TContainer,
    Block,
    SearchContainer,
    Search,
    Sticky,
    TopB,
    BottomB,
    Cname,
    LeftB,
    RightB,
    Price
} from './CourseElements';
import courselogo from '../../images/courselogo.png';
import api from '../../api';

const Course = ({ data }) => {
    const [course, setCourse] = useState([]);

    useEffect(() => {
        api("course/show")
            .then((data) => {
                setCourse(data.courses);
            })
    }, []);

    const list = course.map(({ name, price, i }) => {
        return <Block key={i}>
            <TopB>
                <Cname>
                    {name}
                </Cname>
                <Price>
                    {price}
                </Price>
            </TopB>
            <BottomB>
                <LeftB>
                </LeftB>
                <RightB>
                </RightB>
            </BottomB>
        </Block>
    })

    return course ? (
        <Container>
            <Left>
                <Sticky>
                    <Top>
                        <TContainer>
                            <SearchContainer>
                                <Search type="search" placeholder="سرچ کنید..." />
                            </SearchContainer>
                            <H1>دوره ها</H1>
                            <P>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که </P>
                        </TContainer>
                    </Top>
                    <Bottom>
                        <Img src={courselogo} alt="course logo" />
                    </Bottom>
                </Sticky>
            </Left>
            <Right>
                {list}
                {/* {data.map(({i}) => {
                        return(
                            <Block key={i}>
                                <TopB>
                                    <Cname>
                                        دوره فن بیان
                                    </Cname>
                                    <Price>
                                        ۲۲ تومان
                                    </Price>
                                </TopB>
                                <BottomB>
                                    <LeftB>
                                    </LeftB>
                                    <RightB>
                                    </RightB>
                                </BottomB>
                            </Block>
                        );
                    })} */}
            </Right>
        </Container>
    ) : (
        <Container>
            Loading....
        </Container>
    );
}

export default Course;
