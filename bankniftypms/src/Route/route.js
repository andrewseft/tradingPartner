// CMS Page Routes
import HomePage from "../Pages/Home"
import FaqPage from "../Pages/Faq"
import cmsPage from "../Pages/Cms"
import NotFoundPage from "../Pages/NotFound"

// Auth Page Routes
import LoginPage from "../Pages/Authentication/SignIn"
import RegisterPage from "../Pages/Authentication/Register"
import OtpPage from "../Pages/Authentication/Otp"
import ForgotPasswordPage from "../Pages/Authentication/ForgotPassword"
import ResetPasswordPage from "../Pages/Authentication/RestPassword"

// After login Page Routes
import DashboardPage from "../Pages/Dashboard"
import ProfilePage from "../Pages/Profile"
import ChangePasswordPage from "../Pages/ChangePassword"
import StatementPage from "../Pages/Statement"
import PassBookPage from "../Pages/Passbook"
import WalletPage from "../Pages/Wallet"
import NotificationPage from "../Pages/Notification"
import OrderPage from "../Pages/Order"
import HoldingPage from "../Pages/Holding"
import PositionsPage from "../Pages/Positions"
import PlanDetail from "../Pages/PlanDetail"
import PlanSellDetail from "../Pages/PlanSellDetail"
import Referral from "../Pages/Referral"

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
  { path: "/register", component: RegisterPage, title: "Register" },
  { path: "/otp-verify", component: OtpPage, title: "Otp Verify" },
  {
    path: "/forgot-password",
    component: ForgotPasswordPage,
    title: "Forgot Password",
  },
  {
    path: "/reset-password",
    component: ResetPasswordPage,
    title: "Reset Password",
  },
]

export const RoutesUser = [
  { path: "/user/dashboard", component: DashboardPage, title: "Dashboard" },
  { path: "/user/profile", component: ProfilePage, title: "Profile" },
  {
    path: "/user/change-password",
    component: ChangePasswordPage,
    title: "Change Password",
  },
  {
    path: "/user/statement",
    component: StatementPage,
    title: "Statement",
  },
  {
    path: "/user/passbook",
    component: PassBookPage,
    title: "Passbook",
  },
  {
    path: "/user/notification",
    component: NotificationPage,
    title: "Notification",
  },
  {
    path: "/user/wallet",
    component: WalletPage,
    title: "Wallet",
  },
  {
    path: "/user/order",
    component: OrderPage,
    title: "Order",
  },
  {
    path: "/user/holdings",
    component: HoldingPage,
    title: "Holding",
  },
  {
    path: "/user/positions",
    component: PositionsPage,
    title: "Positions",
  },
  {
    path: "/plan/detail/buy/:slug",
    component: PlanDetail,
    title: "Plan Detail",
  },
  {
    path: "/plan/detail/sell/:slug",
    component: PlanSellDetail,
    title: "Plan Detail",
  },
  {
    path: "/referral",
    component: Referral,
    title: "Referral",
  },
]
