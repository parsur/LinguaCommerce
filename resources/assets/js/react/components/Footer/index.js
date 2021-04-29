import React from 'react';
import { SvgBg, FooterContainer, FooterWrap, SocialMedia, SocialMediaWrap, SocialLogo, SocialIcons, SocialIconLink} from './FooterElements';
import { FaInstagram, FaTelegramPlane } from 'react-icons/fa';
import { SiGmail } from 'react-icons/si';
import { GiHand } from 'react-icons/gi';
import aparat from '../../images/aparat.png';

const Footer = (props) => {
    return (
        <FooterContainer style={props.style}>
            <SvgBg />
            <FooterWrap>
                <SocialMedia>
                    <SocialMediaWrap>
                        <SocialIcons>
                            <SocialIconLink href='https://t.me/joinchat/UzdcLu101RM6DgAp' target='_blank' aria-label='Facebook' rel='noopener noreferrer'>
                                <FaTelegramPlane />
                            </SocialIconLink>
                            <SocialIconLink href='https://instagram.com/sararajabi.ir?igshid=bciy7c50og5w' target='_blank' aria-label='Instagram' rel='noopener noreferrer'>
                                <FaInstagram />
                            </SocialIconLink>
                            <SocialIconLink href='mailto:sararajabiart3@gmail.com' target='_blank' aria-label='Youtube' rel='noopener noreferrer'>
                                <SiGmail />
                            </SocialIconLink>
                            <SocialIconLink href='https://www.joinclubhouse.com/@sararajabi' target='_blank' aria-label='FaTwitter' rel='noopener noreferrer'>
                                <GiHand />
                            </SocialIconLink>
                            <SocialIconLink href='https://m.aparat.com/v/VfvJ2' target='_blank' aria-label='FaTwitter' rel='noopener noreferrer'>
                                <img src={aparat} alt="aparat" width="35px" />
                            </SocialIconLink>
                        </SocialIcons>
                        <SocialLogo to='/'>آموزش فن بیان</SocialLogo>
                    </SocialMediaWrap>
                </SocialMedia>
            </FooterWrap>
        </FooterContainer>
    )
}

export default Footer;