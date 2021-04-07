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
})

export default function combinedRootReducer(state, action) {
  return action.type === "LOG_OUT"
    ? rootReducer(initialState, action)
    : rootReducer(state, action)
}
