<template>
<div>

    <VueFaqAccordion :items="myItems" />
</div>
</template>

<script>
import VueFaqAccordion from 'vue-faq-accordion'

export default {

    components: {
        VueFaqAccordion
    },
    data() {
        return {
            myItems: [{
                    title: '1. Privacy Policy',
                    value: 'Dellmat, is committed to making your search for the perfect mattress and a great night sleep as simple and comfortable as possible. Respecting your privacy is an extension of this service and this policy outlines the types and use of information that you have shared with us as part of using our online services.' + '<br />' + 'In continuing to use this website, you agree to the collection, use and selective disclosure of your personally identifiable information as described below. If you do not agree to the terms of this Privacy Policy, please do not continue to use this website.',
                    category: 'PRIVACY POLICY'
                },
                {
                    title: '2. What type of information do we collect?',
                    value: `<b>Personal Information</b><br />Personal information is information that specifically identifies you as an individual, such as your name, address, telephone number, e–mail address, credit card or other account number, as well as information about your activities, such as your purchases. Personal information also includes demographic information, such as date of birth, gender, geographic area and preferences when such information is linked to other personal information that identifies you.<br /><br /><br />
                    <strong>Non-personal Information.</strong>
                    <br />
                    As part of the standard operation of this website, we may collect certain non-personal information from your use of the site, including, but not limited to your Internet IP address, browser type, domain, access device, referring website addresses, date, time and duration of visit by page, return visit frequency and other information on your browsing behavior. This data serves to help us understand trends and customer needs so that we can improve our products and services to enhance your shopping experience.
                    `,
                    category: 'PRIVACY POLICY'
                },
                {
                    title: '3. When do we collect this information?',
                    value: `We only collect personal information from you when you <br />
                    1) Register on the Dellmat website and create an account, including any account created using already established social networking accounts such as Facebook  <br />
                    2) Complete a survey.  <br />
                    3) Sign up for our e-mail list, offers, promotions or newsletter.  <br />
                    4) Share content from this website with your friends and family.  <br />
                    5) Contact us by e-mail or by using the chat feature for any reason.  <br />
                    6) Order products and services.  <br /> <br />
                    This website is intended for general audience and not directed to children less than 18 years of age and we do not knowingly collect personal information from children under 18 years of age.

                    `,
                    category: 'PRIVACY POLICY'
                },
                {
                    title: '4. How do we collect your information?',
                    value: `<b>COOKIES</b> <br />
                    A cookie is a small text file that may be stored on the hard drive of your computer when you access the website. A "session cookie" expires immediately when you end your session (i.e., close your browser). A "persistent cookie" stores information on the hard drive so when you end your session and return to the same website at a later date, the cookie information is still available. When you visit our website, we may use both a session and a persistent cookie. These cookies may contain information (such as a unique user ID) that is used to track your usage of our website and in some cases, your e-mail address. Your e- mail address is only saved in this cookie if you register with us.
                    <br />When you register with us, this cookie allows us to recognize you when you return to our website and provides you with access to your account information. If you save your information with or order from us, we may also use cookies to monitor and maintain information about your use of our website.
                    <br /><br />
                         If you have not saved your information with or ordered from us, we may monitor and maintain information about your use of our website in a manner that does not identify you. We may use cookies to collect the non-personal information described above in order to: <br />
                        1) Provide you with customized content and advertising<br />
                        2) Monitor website usage<br />
                        3) Conduct research to improve our content and services.<br />
                        You are free to decline cookies, but by doing so, you may not be able to use certain features on this website or take full advantage of all our offerings. Check the “Help” menu of your browser to learn how to change your cookie preferences.
                        <br />
                        <br />
                        <strong>PIXEL TAGS</strong>
                        A pixel tag (also known as a web beacon) is a small string of code that represents a clear graphic image and is used in conjunction with a cookie. A pixel tag allows us to capture certain additional types of information about a visitor's actions on a web site, such as a visitor's cookie number, the time, date, duration and number of page views, a description of the page where the tag is placed and details about any items that were purchased. Pixel tags help us analyze our customers' online behavior and measure the effectiveness of our website and our advertising. We work with service providers that help us track, collect and analyze this information.
                        <br />
                        <strong>CLICKSTREAM DATA</strong>
                        Clickstream data is a record of your activity on the Internet. This data is recorded whenever you click anywhere in a webpage or application and is used for the purposes of collecting, analyzing and reporting data about how you use the Site. This method of data collection is used to capture non-personal information.
                       `,
                    category: 'PRIVACY POLICY'
                },
                {
                    title: '5. How do we use the information?',
                    value: `We may share your personal information across our departments, affiliate and subsidiary companies in order to improve your shopping experience on this website. At other times, we may also share your personal information with service providers and other third parties that need access to your personal information to provide us with operational or other support services, such as payment processors, shipping agents, other vendors and fraud prevention service providers, or for marketing research analytics. Dellmat.com takes steps to ensure that the third parties agree to appropriate restrictions on the disclosure and use of your information. Unless otherwise disclosed to you, these third parties are prohibited from using your personal information for their own marketing purposes. We do not rent or sell your personal information to marketers outside of our network and partners, unless indicated in this Privacy Policy or you otherwise authorize us to do so.
                    <br/>
                    We may also use your personal and non-personal information collected for the following purposes:
                    <br/>

                    1) to fulfill your requests for products and services; <br/>
                    2) to provide you with targeted offers and advertising; <br/>
                    3) to contact you with information, promotions from Dellmat as well as from our subsidiaries, affiliates, marketing partners, advertisers and other third parties; <br/>
                    4) to contact you if there is a problem with your order; <br/> 5) to ask you to review your in-store experience with us; <br/> 6) to review this website’s usage and operations; <br/>
                    7) to conduct marketing research in order to optimize our search engine marketing strategies; and
                    8) to guard against fraud, we may verify and/or supplement your personal information with information from third party sources.

                    <br/>
                    In addition, we reserve the right to further use or disclose any information without notice or consent to the following entities for the following purposes: <br/>
                    1) to our employees, independent contractors, subsidiaries, affiliates, consultant, business associates, service providers and suppliers, if the disclosure will enable any of these entities to perform a business, professional or technical support function for us; <br/>
                    2) to our employees, independent contractors, service providers and suppliers, to fulfill a product or service request; <br/>
                    3) as necessary if we believe that there has been a violation of the website’s Terms of Use or of our rights or the rights of any third party; <br/>
                    4) to respond to judicial process and provide information to law enforcement agencies or in connection with an investigation on matters related to public safety, as permitted or as required by law; <br/>
                    5) to conduct investigations of consumer complaints or fraud <br/>
                    `,
                    category: 'PRIVACY POLICY'
                },
                {
                    title: '6. How secure is our site?',
                    value: `     We take your security when using this website, very seriously. We have taken certain physical, electronic, contractual and managerial steps to safeguard and secure the information we collect from the website
                    users. We limit the access to private and confidential data to only employees with a specific need to retrieve this information. To maintain this level of security, we do not store private information on the website. We do not direct the website to, nor do we knowingly collect, any personal information from children under the age of eighteen.
                    <br />
                    All of your information is encrypted before it is transmitted across the Internet. Additionally, the information you provide when you place an order is encrypted (or coded) using a secure server for maximum security. This coding makes it extremely difficult for anyone to reach your information as it moves through our ordering system.
                    <br />
                    Most of the pages on our site provide information about our company, our products and do not contain secure information. This information is available freely and there's no reason for these pages to be secure. Pages like "Checkout area" and pages on which you actually make a purchase, manage your account, or check your order status are made secure. This means, the entire checkout process, from introduction to final confirmation, is completely secure. When confirming an order, the confirmation page will display your shipping address, billing address, and payment method (e.g. credit card, Mpesa). Your credit card number will not be displayed on this page. When you are logged into your account, your profile page will display the last four digits of the credit card you have on file. It will not display your full credit card number. New credit card information may be added or current credit card information deleted, but you will not be able to edit any of your credit card information.
                    <br />
                    When you create an account on our site, we will store some of your personal information. This will include your name, login information (except passwords), shipping address, billing address, order information, wish list information, and payment settings Should you log in using a social media site such as Facebook, we will capture and store that login information as well.
                    <br />
                    To check if your computer is secure, look for a padlock to either the left or right of the URL. If you see a closed padlock, then the encryption technology is active and the server is secure. You can also check by looking at the URL line of your browser. When you access a secure server, the initial characters of the site address will be "https."
                    <br />
                    By use of this website, you also have an obligation to safeguard your own personal information. It is your responsibility to ensure that your password and profile information is kept confidential, when you sign up for an account on this website. The best passwords use complex characters with unique number, letters and special characters. Always make sure you log out before leaving this website. Change your password in case you believe it has been compromised.`,
                    category: 'PRIVACY POLICY'
                },
                {
                    title: '7. Third-Party Websites & Advertising',
                    value: `     This website may contain links to third-party websites, which may have privacy policies that differ from our own. We are not responsible for the activities and practices that take place on these sites. Accordingly, we recommend that you review the privacy policy posted on any site that you may access through our website.
                    <br />
                    From time to time we use third-party service providers to serve advertisements (banners or links) on our behalf across the Internet.
                    <br />
                    These advertising service providers may collect non-identifiable information about your visits to our website, and your interactions with our products and services. Such non-identifiable information does not include your name, address, e-mail address or other personal information. The information is collected through the use of cookies and pixel tags.
                    <br />
                    In addition to the information about your visits to our website, our service providers may also use the information about your visits to other websites to target advertisements for products and services available from Dellmat.com
                    Currently, we use third party-placed tracking pixels and cookies from the following advertising delivery partners: Google Ad Display Network, In the future we may partner with other companies to provide interest-based advertising, both on and off this website. You are at any time free to manage your third-party advertising preferences by clicking on the links below:
                    <br />
                    If you would like more information about this practice and to know your choices for not having this information used by third-party service providers, please
                    visit <a href="http://www.networkadvertising.org/managing/opt_out.asp" target="_blank">http://www.networkadvertising.org/managing/opt_out.asp</a>
                    <br />
                    <b>FACEBOOK CUSTOM AUDIENCE ADS</b>
                    We work with Google Ad Network to help us personalize our ads based on your shopping experience and interests across the internet. You can opt out of this ad match at any time by managing your ad preferences on Google.
                    <br />
                    <b>GOOGLE CUSTOM MATCH ADS</b>
                    We work with Google Ad Network to help us personalize our ads based on your shopping experience and interests across the internet. You can opt out of this ad match at any time by managing your ad preferences on Google.
                    <br />
                    <b>EMAIL MARKETING</b>
                    When you opt in by subscribing to our newsletters, offers and promotions, you receive marketing e-mails from us from time to time. Should you wish to unsubscribe, you can do so by clicking on the Unsubscribe hyperlink at the bottom of the marketing e-mail you receive. Your record may still remain in our database but you will not receive any future mailings from us.
                    You can also opt out of e-mails by sending an e-mail to us at <a href="mailto:info@dellmat.com" target="_blank">info@dellmat.com</a>  requesting us to unsubscribe a specific e-mail address.`,
                    category: 'PRIVACY POLICY'
                },
                {
                    title: '8. Changes to this Privacy Policy',
                    value: `We may change this Privacy Policy from time to time. Any significant changes will be posted online or shared with you via email. We will do our best to give ample notice for changes that affect you or the information, use of information you may have provided us with.
                    <br />
                    If you have any questions or concerns about this Privacy Policy, please contact us at <a href="mailto:info@dellmat.com" target="_blank">info@dellmat.com</a>.`,
                    category: 'PRIVACY POLICY'
                },
            ]
        }
    }
}
</script>

<style>
.faq-wrapper {
    max-width: 80% !important;
    /* width: 80% !important; */
    margin: auto !important;
}

.accordion__item {
    border-bottom: 1px solid #488fef !important;
}

.accordion[data-v-dd43507e] {
    border: 1px solid #488fef !important;
}
</style>
