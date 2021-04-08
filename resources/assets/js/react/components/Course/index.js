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
    SelectS,
    NoResult,
    VscSearchStops,
    OtherCourses,
    OCTop,
    OCBottom,
    OCHR,
    H3,
    Suggested
} from './CourseElements';
import courselogo from '../../images/courselogo.png';
import api from '../../api';
import { AiOutlineSearch } from 'react-icons/ai';
import { Link } from 'react-router-dom';
import Loader from 'react-loader-spinner';
import axios from 'axios';
import CourseDetails from '../CourseDetails';

const options = [
    { value: 'دسته بندی اول', label: 'دسته بندی اول' },
    { value: 'دسته بندی دوم', label: 'دسته بندی دوم' },
    { value: 'دسته بندی سوم', label: 'دسته بندی سوم' }
  ]

const token = 'parsur';

const Course = ({ data }) => {
    const [course, setCourse] = useState(null);
    const [search, setSearch] = useState("");
    const [noRes, setNoRes] = useState(null);

    useEffect(() => {
        api("api/course/show")
            .then((data) => {
                setCourse([])
                setCourse(data.courses);
            })
    }, []);

    function submit(){
        console.log(search);
        axios.post('http://sararajabi.com/api/course/search', {
            search: search,
        }, {
            headers: {
              'api_key': `Basic ${token}` 
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
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        });
    }

    

    function handleSearchChaneg(event){
        if (event.target.value === "") {
            api("api/course/show")
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

    return course ? (
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
                {noRes}
            {course.map(({ name, price, id }, i) => {
        return( <Block key={i}>

            <MainB to={`course/${id}`}>

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
            
            </Block> );
    })}

                {/* <OtherCourses>

                    <OCTop><H3>دوره های منتخب</H3></OCTop>

                    <OCHR/>

                    <OCBottom>

                        <Suggested>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام </Suggested>
                        <Suggested>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام </Suggested>
                        <Suggested>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام </Suggested>
                        <Suggested>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام </Suggested>
                        <Suggested>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام </Suggested>
                        <Suggested>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام </Suggested>

                    </OCBottom>

                </OtherCourses> */}

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