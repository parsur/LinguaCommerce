import React, { useEffect, useState } from 'react';
import {
    Container,
    Left,
    Right,
    Top,
    Bottom,
    Img,
    H1,
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
    SelectS,
    NoResult,
    VscSearchStops,
} from './CourseElements';
import courselogo from '../../images/courselogo.png';
import api from '../../api';
import { AiOutlineSearch } from 'react-icons/ai';
import Loader from 'react-loader-spinner';
import axios from 'axios';
import whymebg from '../../images/test2bg.jpeg';
import apiAxios from '../../axios';

const token = 'parsur';

const Course = ({ data }) => {
    const [course, setCourse] = useState(null);
    const [search, setSearch] = useState("");
    const [noRes, setNoRes] = useState(null);
    const [categories, setCategories] = useState([]);
    const [subCategories, setSubCategories] = useState([]);
    const [selectedOption, setSelectedOption] = useState(0);
    const [selectedOptionTwo, setSelectedOptionTwo] = useState(0);

    useEffect(() => {
        api("api/v1/course/show")
            .then((data) => {
                setCourse([])
                setCourse(data.courses);
                console.log(data);
                setCategories(data.categories);
                setSubCategories(data.subcategories);
                if(data.subcategories === []){
                    setCategories([{"name" : "mamad", "id" : "20"}])
                }
            })
    }, []);

    const options = categories.map(({name, id}) => ({ value: id, label: name }))
    const optionsTwo = subCategories.map(({name, id}) => ({ value: id, label: name }))
    
    function submit(){
        axios.post('http://sararajabi.com/api/v1/course/search', {
            search: search,
            category_id: selectedOption,
            sub_category_id: selectedOptionTwo,
            column: 'name',
        }, {
            headers: {
              'api_key': `${token}` 
            }
          }
        )
        .then(function (response) {
            setCourse(response.data);
            if(response.data === ''){
                setNoRes(noResult);
                setCourse([]);
            } else {
                setNoRes(null);
            }
        })
        .catch(function (error) {
            console.log(error);
        });
    }

    function handleSearchChaneg(event){
        if (event.target.value === "") {
            api("api/v1/course/show")
            .then((data) => {
                setCourse(data.courses);
            })
            setNoRes(null)
        } else {
            setSearch(event.target.value);
        }
    }

    const noResult = function () {
        return (
            <NoResult><VscSearchStops/>متاسفانه نتیجه ای پیدا نشد!</NoResult>
        );
    }

    function handleChange(selectedOption){
        setSelectedOption(selectedOption.value);
        sendDetails();
    }

    function handleChangeTwo(selectedOptionTwo){
        setSelectedOptionTwo(selectedOptionTwo.value)
    };

    function sendDetails(){
        setSubCategories([])
        apiAxios(`/sub_category?category_id=${selectedOption}`)
        .then(function ({ data }) {
            setSubCategories(data);
        })
        .catch(function (error) {
            console.log(error);
        });
      };
    
    function handlePrice(price){
        if(price === null){
            return <Pn>رایگان</Pn>
        } else {
            return <Pn>{price} تومان</Pn>
        }
    }

    function mediaCaller(media){
        if(media == 0){
            return whymebg
        } else {
            return "http://sararajabi.com/images/" + media[0].url
        }
    }

    return course ? (
        <Container>
            <Left>
                <Sticky>
                    <Top>
                        <TContainer>
                            <SearchContainer onSubmit={event => event.preventDefault()}>
                                <Searchs>
                                    <Search onChange={handleSearchChaneg} type="search" id="search" placeholder="سرچ کنید..." />
                                    <Submit onClick={()=>submit()} type="submit" value="جستجو"><AiOutlineSearch/></Submit>
                                </Searchs>
                                <FilterContainer>
                                    <Filter>
                                        <SelectS options={options} onChange={handleChange} placeholder="دسته بندی اول" />
                                    </Filter>
                                    <Filter>
                                        <SelectS options={optionsTwo} onChange={handleChangeTwo} placeholder="دسته بندی دوم" />
                                    </Filter>
                                </FilterContainer>
                            </SearchContainer>
                            <H1>دوره ها</H1>
                        </TContainer>
                    </Top>
                    <Bottom>
                        <Img src={courselogo} alt="course logo" />
                    </Bottom>
                </Sticky>
            </Left>
            <Right>
                {noRes}
            {course.map(({ name, price, id, media }, i) => {
        return( <Block key={i}>

            <MainB to={`course/${id}`}>

                <Photo><img style={{height:"100%",maxWidth:"100%"}} src={mediaCaller(media)} alt="course"/></Photo>

                <Name>

                    <NameH>{name}</NameH>

                </Name>

                <Price>

                    <Green>

                        {handlePrice(price)}

                    </Green>

                </Price>

            </MainB>
            
            </Block> );
    })}

            </Right>
        </Container>
    ) : (
        <Container>
            <Left>
                <Sticky>
                    <Top>
                        <TContainer>
                            <SearchContainer onSubmit={event => event.preventDefault()}>
                                <Searchs>
                                    <Search onChange={handleSearchChaneg} type="search" id="search" required="required" placeholder="سرچ کنید..." />
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
                        </TContainer>
                    </Top>
                    <Bottom>
                        <Img src={courselogo} alt="course logo" />
                    </Bottom>
                </Sticky>
            </Left>
            <Right>
            <div style={{width:"100%", height:"50%", display:"flex"}}>
            <Loader
            type="Oval"
            color="#F4DD4F"
            height={150}
            width={150}
            timeout={3000} //3 secs
            style={{margin: "auto"}}
            />
        </div>
            </Right>
        </Container>
    );
}

export default Course;