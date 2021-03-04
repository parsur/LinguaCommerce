import React from 'react';
import { SvgBg, FooterContainer, FooterWrap, SocialMedia, SocialMediaWrap, SocialLogo, SocialIcons, SocialIconLink} from './FooterElements';

const Footer = () => {
    return (
        <FooterContainer>
            <SvgBg />
            <FooterWrap>
                <SocialMedia>
                    <SocialMediaWrap>
                        <SocialIcons>
                            <SocialIconLink href='/' target='_blank' aria-label='Facebook' rel='noopener noreferrer'>
                            </SocialIconLink>
                            <SocialIconLink href='/' target='_blank' aria-label='Instagram' rel='noopener noreferrer'>
                            </SocialIconLink>
                            <SocialIconLink href='/' target='_blank' aria-label='Youtube' rel='noopener noreferrer'>
                            </SocialIconLink>
                            <SocialIconLink href='/' target='_blank' aria-label='FaTwitter' rel='noopener noreferrer'>
                            </SocialIconLink>
                        </SocialIcons>
                        <SocialLogo to='/'>فن بیان</SocialLogo>
                    </SocialMediaWrap>
                </SocialMedia>
            </FooterWrap>
        </FooterContainer>
    )
}

export default Footer;