import React from 'react';
import Modal from 'react-modal';
import { useSpring, animated } from 'react-spring';
import {
    Imagebruh,
    TopContainer,
    Filters,
    Search,
    MiddleContainer,
    LeftContainer,
    SearchResults,
    RightContainer,
    ModalH2,
    ButtomContainer,
    ResultCol,
    ResultContainer,
    ResultLeft,
    ResultImg,
    ResultRight,
    ResultH2,
    Hr,
    ResultP,
    ButtonContainer,
    Button
} from './SearchModalElemnts';

Modal.setAppElement('#app');

const SearchModal = ({modalIsOpen, setmodalIsOpen}) => {

    const animation = useSpring({
        condig: {
            duration: 250
        },
        opacity: modalIsOpen ? 1 : 0,
        transform: modalIsOpen ? `translateY(0%)` : `translateY(100%)`
    })

    return (
        <>
        
            <Modal
            isOpen={modalIsOpen}
            onRequestClose={() => setmodalIsOpen(false)}
            style={
                {
                    content: {
                        background: "#F7BC46"
                    },
                    overlay: {
                        background: "rgba(555, 555, 555, 0.3)"
                    }
                }
            }
            >
            <Imagebruh>
                <animated.div style={animation}>
                    <TopContainer>
                        <Filters />
                        <Search type='text' id='search' name='searchinput' placeholder='اینجا سرچ کنید...' />
                    </TopContainer>
                    <MiddleContainer>
                        <LeftContainer>
                            <SearchResults>دوره خندان</SearchResults>
                        </LeftContainer>
                        <RightContainer>
                            <ModalH2>نتایج سرچ برای</ModalH2>
                        </RightContainer>
                    </MiddleContainer>
                    <ButtomContainer>
                        <ResultCol>
                            <ResultContainer>
                                <ResultLeft><ResultImg alt='course logo'/></ResultLeft>
                                <ResultRight>
                                    <ResultH2>دوره خندان</ResultH2>
                                    <Hr />
                                    <ResultP>دوره ای که میخندی ها ها ها ها ها ها ها ها</ResultP>
                                </ResultRight>
                            </ResultContainer>
                        </ResultCol>
                        <ResultCol>
                            <ResultContainer>
                                <ResultLeft><ResultImg alt='course logo'/></ResultLeft>
                                <ResultRight>
                                    <ResultH2>دوره خندان</ResultH2>
                                    <Hr />
                                    <ResultP>ها ها ها ها ها ها ها ها دوره ای که میخندی</ResultP>
                                </ResultRight>
                            </ResultContainer>
                        </ResultCol>
                        <ResultCol>
                            <ResultContainer>
                                <ResultLeft><ResultImg alt='course logo'/></ResultLeft>
                                <ResultRight>
                                    <ResultH2>دوره خندان</ResultH2>
                                    <Hr />
                                    <ResultP>ها ها ها ها ها ها ها ها دوره ای که میخندی</ResultP>
                                </ResultRight>
                            </ResultContainer>
                        </ResultCol>
                        <ResultCol>
                            <ResultContainer>
                                <ResultLeft><ResultImg alt='course logo'/></ResultLeft>
                                <ResultRight>
                                    <ResultH2>دوره خندان</ResultH2>
                                    <Hr />
                                    <ResultP>ها ها ها ها ها ها ها ها دوره ای که میخندی</ResultP>
                                </ResultRight>
                            </ResultContainer>
                        </ResultCol>
                    </ButtomContainer>
                    <ButtonContainer>
                        <Button onClick={() => setmodalIsOpen(false)}>بستن پنجره</Button>
                    </ButtonContainer>
                </animated.div>
            </Imagebruh>
            </Modal>
        </>
    )
}

export default SearchModal;