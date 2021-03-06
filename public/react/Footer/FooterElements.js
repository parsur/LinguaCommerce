import styled from 'styled-components';
import { Link } from 'react-router-dom';
import Footerbg from '../../images/footerbg.svg';

export const FooterContainer = styled.footer`
`;

export const SvgBg = styled.div`
  background: url(${Footerbg});
  background-repeat: repeat-x;
  width: 100%;
  height: 100px;
  margin-bottom: -80px;

  @media screen and (min-width: 600px) {
    height: 130px;
    margin-bottom: -100px;
  }
`

export const FooterWrap = styled.div`
  background: #e2e2e2;
  background-repeat: repeat-x;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  max-width: 1300px;
  margin: 0 auto;
  padding: 0 24px 15px 24px;
`;

export const SocialMedia = styled.section`
  max-width: 1300px;
  width: 100%;
`;

export const SocialMediaWrap = styled.div`
  display: flex;
  flex-wrap: wrap-reverse;
  justify-content: space-between;
  align-items: center;
  max-width: 1100px;
  margin: 16px auto 0 auto;
  @media screen and (max-width: 500px) {
    justify-content: space-evenly;
  }
`;

export const SocialLogo = styled(Link)`
  color: #000;
  justify-self: start;
  cursor: pointer;
  text-decoration: none;
  font-size: 1.5rem;
  display: flex;
  align-items: center;
  margin-bottom: 16px;
  font-weight: bold;
  direction: rtl;
`;

export const SocialIcons = styled.div`
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 240px;
`;

export const SocialIconLink = styled.a`
  color: #000;
  font-size: 24px;
`;