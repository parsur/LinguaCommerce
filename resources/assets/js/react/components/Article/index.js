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
    Submit,
    MainB,
    Photo,
    Name,
    Price,
    NameH,
    Green,
    Pn,
    FilterContainer,
    Searchs,
    Filter,
    SelectS
} from './DetailsElements';
import courselogo from '../../images/courselogo.png';
import api from '../../api';
import { AiOutlineSearch } from 'react-icons/ai';
import { Link } from 'react-router-dom';
import Loader from 'react-loader-spinner';

const options = [
    { value: 'دسته بندی اول', label: 'دسته بندی اول' },
    { value: 'دسته بندی دوم', label: 'دسته بندی دوم' },
    { value: 'دسته بندی سوم', label: 'دسته بندی سوم' }
  ]

const Article = ({ data }) => {
    const [course, setCourse] = useState([]);
    const [search, setSearch] = useState("");

    useEffect(() => {
        api("api/course/show")
            .then((data) => {
                setCourse(data.courses);
            })
    }, []);

    const list = course.map(({ name, price, description: { description }, i }) => {
        return <Block key={i}>

            <MainB to="/articledetails">

                <Photo></Photo>

                <Name>

                    <NameH>{name}</NameH>

                </Name>

                <Price>

                    <Green>

                        <Pn>{price} تومان</Pn>

                    </Green>

                </Price>

            </MainB>
            
            </Block>
    })

    function submit(){
        console.log(search);
        fetch('http://sararajabi.com/api/course/search',{
            method:'post',
            body: {
                search: search,
            },
            headers:{
                'Accept' : 'application/json',
                'Content-Type' : 'application/json'
            }
        }).then(function(response){
            response.json().then(function(resp){
                console.log(resp)
            })
        })
    }

    return course ? (
        <Container>
            <Left>
                <Sticky>
                    <Top>
                        <TContainer>
                            <SearchContainer onSubmit={event => event.preventDefault()}>
                                <Searchs>
                                    <Search onChange={(item)=>setSearch(item.target.value)} type="search" id="search" required="required" placeholder="سرچ کنید..." />
                                    <Submit onClick={()=>submit()} type="submit" value="جستجو"><AiOutlineSearch/></Submit>
                                </Searchs>
                                <FilterContainer>
                                    <Filter>
                                        <SelectS options={options} placeholder="دسته بندی اول" />
                                    </Filter>
                                    <Filter>
                                        <SelectS options={options} placeholder="دسته بندی دوم" />
                                    </Filter>
                                </FilterContainer>
                            </SearchContainer>
                            <H1>دوره ها</H1>
                            <P>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک </P>
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
        <div>Loading...</div>
    );
}

export default Article;
