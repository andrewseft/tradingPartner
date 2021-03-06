import { combineReducers } from "redux"

import initialState from "./initialState"
import isAuth from "./isAuthRequest"
import isSubmitting from "./isSubmittingRequest"
import isFetching from "./networkRequest"
import userInfo from "./userInfoReducer"
import setting from "./settingReducer"
import homePageData from "./homePageReducers"
import pageData from "./pageReducers"
import userParams from "./userParamsReducer"
import investmentCapital from "./investmentCapitalReducer"
import plan from "./planReducer"
import userDashbord from "./userDashbordReducer"
import statement from "./statmentReducer"
import passbook from "./passbookReducer"
import notification from "./notificationReducer"
import walletAmount from "./amountReducers"
import order from "./orderReducer"
import holding from "./holdingReducer"
import holdingList from "./holdingListReducer"
import planDetail from "./planDetailReducer"

const rootReducer = combineReducers({
  isAuth,
  isSubmitting,
  isFetching,
  userInfo,
  setting,
  homePageData,
  pageData,
  userParams,
  investmentCapital,
  plan,
  userDashbord,
  statement,
  passbook,
  notification,
  walletAmount,
  order,
  holding,
  holdingList,
  planDetail,
})

export default function combinedRootReducer(state, action) {
  return action.type === "LOG_OUT"
    ? rootReducer(initialState, action)
    : rootReducer(state, action)
}
