// CMS Page Routes
import HomePage from "../Pages/Home"
import FaqPage from "../Pages/Faq"
import cmsPage from "../Pages/Cms"
import NotFoundPage from "../Pages/NotFound"
import LoginPage from "../Pages/Authentication/SignIn"

export const RoutesPage = [
  { path: "/", component: HomePage, title: "Home" },
  {
    path: "/what-we-offer",
    component: HomePage,
    title: "What We Offer",
  },
  { path: "/why-us", component: HomePage, title: "Why Us" },
  { path: "/features", component: HomePage, title: "Features" },
  { path: "/contact-us", component: HomePage, title: "Contact Us" },
  { path: "/download", component: HomePage, title: "Home" },
  { path: "/faq", component: FaqPage, title: "FAQ's" },
  { path: "/privacy-policy", component: cmsPage, title: "Privacy Policy" },
  {
    path: "/cancellation-policy",
    component: cmsPage,
    title: "Cancellation Policy",
  },
  { path: "/return-policy", component: cmsPage, title: "Return Policy" },
  {
    path: "/terms-conditions",
    component: cmsPage,
    title: "Terms and Conditions",
  },
  { path: "/404", component: NotFoundPage, title: "404" },
]

export const RoutesAuth = [
  { path: "/login", component: LoginPage, title: "Login" },
]
