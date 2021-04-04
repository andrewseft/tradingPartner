import * as types from "./actionsTypes"
import { agent } from "../utils/agent"
import * as API from "../utils/apiPath"
import { setToaster } from "../utils/helpers"
import submittingRequestStatus from "./submittingRequestStatusAction"

export function loadHomePageDataSuccess(homePageData) {
  return { type: types.LOAD_HOME_PAGE_DATA_SUCCESS, homePageData }
}

export function loadPageDataSuccess(pageData) {
  return { type: types.LOAD_PAGE_DATA_SUCCESS, pageData }
}

export function loadCapitalDataSuccess(investmentCapital) {
  return { type: types.INVESTMENT_CAPITAL_SUCCESS, investmentCapital }
}

export const loadHomePageData = () => async (dispatch) => {
  try {
    const response = await agent.get(API.HOME_PAGE)
    dispatch(loadHomePageDataSuccess(response.data.data))
  } catch (error) {
    setToaster(error.message)
  }
}

export const loadPageData = (slug) => async (dispatch) => {
  try {
    const response = await agent.get(API.CMS_PAGE + slug)
    dispatch(loadPageDataSuccess(response.data.data))
  } catch (error) {
    setToaster(error.message)
  }
}

export const submitContactRequest = (params) => async (dispatch) => {
  try {
    dispatch(submittingRequestStatus(true))
    const response = await agent.post(API.SUBMIT_CONTACT_REQUEST, params)
    setToaster(response.data.message, "#49BE00")
    dispatch(submittingRequestStatus(false))
  } catch (error) {
    setToaster(error.message)
    dispatch(submittingRequestStatus(false))
  }
}

export const loadInvestmentCapital = () => async (dispatch) => {
  try {
    const response = await agent.get(API.GET_INVESTMENT_CAPITAL)
    dispatch(loadCapitalDataSuccess(response.data.data))
  } catch (error) {
    setToaster(error.message)
  }
}
