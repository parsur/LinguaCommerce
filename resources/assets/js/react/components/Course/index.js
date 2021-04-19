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
                setCategories(data.categories);
                setSubCategories(data.subCategories);
                if(data.subCategories === []){
                    setCategories([{"name" : "mamad", "id" : "20"}])
                }
                console.log(data)
            })
    }, []);

    const options = categories.map(({name, id}) => ({ value: id, label: name }))
    const optionsTwo = subCategories.map(({name, id}) => ({ value: id, label: name }))
    
    function submit(){
        console.log(search);
        axios.post('http://sararajabi.com/api/v1/course/search', {
            search: search,
            category_id: selectedOption,
            sub_category_id: selectedOptionTwo,
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
    function sendDetails(){
        axios.get('http://sararajabi.com/api/v1/sub_category', {
            category_id: selectedOption,
        }, {
            headers: {
              'api_key': `${token}` 
            }
          }
        )
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        });
      };

    function handleChangeTwo(selectedOptionTwo){
        setSelectedOptionTwo(selectedOptionTwo.value)
    };
    
    function handlePrice(price){
        if(price === null){
            return <Pn>رایگان</Pn>
        } else {
            return <Pn>{price} تومان</Pn>
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
            {course.map(({ name, price, id }, i) => {
        return( <Block key={i}>

            <MainB to={`course/${id}`}>

                <Photo></Photo>

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