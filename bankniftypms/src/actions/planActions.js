import * as types from "./actionsTypes"
import { agent } from "../utils/agent"
import * as API from "../utils/apiPath"
import toggleNetworkRequestStatus from "./toggleNetworkRequestStatus"

export function loadPlanDataSuccess(plan) {
  return { type: types.PLAN_DATA_SUCCESS, plan }
}

export function loadStatementDataSuccess(statement) {
  return { type: types.STATEMENT_DATA_SUCCESS, statement }
}

export function loadPassbookDataSuccess(passbook) {
  return { type: types.PASSBOOK_DATA_SUCCESS, passbook }
}

export function loadNotificationDataSuccess(notification) {
  return { type: types.NOTIFICATION_DATA_SUCCESS, notification }
}

export function loadPlanDetailDataSuccess(planDetail) {
  return { type: types.LOADED_PLAN_DETAIL_DATA_SUCCESS, planDetail }
}

export const getPlanData = () => async (dispatch) => {
  try {
    dispatch(toggleNetworkRequestStatus(true))
    const response = await agent.post(API.PLAN)
    dispatch(toggleNetworkRequestStatus(false))
    dispatch(loadPlanDataSuccess(response.data.data))
  } catch (error) {
    dispatch(toggleNetworkRequestStatus(false))
  }
}

export const getStatementData = (request) => async (dispatch) => {
  try {
    dispatch(toggleNetworkRequestStatus(true))
    const response = await agent.post(API.GET_STATEMENT, request)
    dispatch(toggleNetworkRequestStatus(false))
    dispatch(loadStatementDataSuccess(response.data.data))
  } catch (error) {
    dispatch(toggleNetworkRequestStatus(false))
  }
}

export const getPassbookData = () => async (dispatch) => {
  try {
    dispatch(toggleNetworkRequestStatus(true))
    const response = await agent.get(API.GET_PASSBOOK)
    dispatch(toggleNetworkRequestStatus(false))
    dispatch(loadPassbookDataSuccess(response.data.data))
  } catch (error) {
    dispatch(toggleNetworkRequestStatus(false))
  }
}

export const getNotificationData = () => async (dispatch) => {
  try {
    dispatch(toggleNetworkRequestStatus(true))
    const response = await agent.get(API.GET_NOTIFICATION)
    dispatch(toggleNetworkRequestStatus(false))
    dispatch(loadNotificationDataSuccess(response.data.data))
  } catch (error) {
    dispatch(toggleNetworkRequestStatus(false))
  }
}

export const clearNotification = () => async (dispatch) => {
  try {
    dispatch(toggleNetworkRequestStatus(true))
    await agent.get(API.REMOVE_ALL_NOTIFICATION)
    dispatch(toggleNetworkRequestStatus(false))
    dispatch(loadNotificationDataSuccess([]))
  } catch (error) {
    dispatch(toggleNetworkRequestStatus(false))
  }
}

export const getStatementLinkData = (request) => async (dispatch) => {
  try {
    dispatch(toggleNetworkRequestStatus(true))
    const response = await agent.post(API.GET_STATEMENT_LINK, request)
    dispatch(toggleNetworkRequestStatus(false))
    window.open(response.data.data, "_blank")
  } catch (error) {
    dispatch(toggleNetworkRequestStatus(false))
  }
}

export const getPlanDetailData = (slug) => async (dispatch) => {
  try {
    dispatch(loadPlanDetailDataSuccess({}))
    dispatch(toggleNetworkRequestStatus(true))
    const response = await agent.get(API.GET_PLAN_DETAIL + slug)
    dispatch(toggleNetworkRequestStatus(false))
    dispatch(loadPlanDetailDataSuccess(response.data.data))
  } catch (error) {
    dispatch(toggleNetworkRequestStatus(false))
  }
}

export const buyPlan = (request, push) => async (dispatch) => {
  try {
    dispatch(toggleNetworkRequestStatus(true))
    await agent.post(API.BUY_PLAN_DETAIL, request)
    dispatch(toggleNetworkRequestStatus(false))
    push("/user/order")
  } catch (error) {
    dispatch(toggleNetworkRequestStatus(false))
  }
}

export const sellPlan = (request, push) => async (dispatch) => {
  try {
    dispatch(toggleNetworkRequestStatus(true))
    await agent.post(API.SELL_PLAN_DETAIL, request)
    dispatch(toggleNetworkRequestStatus(false))
    push("/user/order")
  } catch (error) {
    dispatch(toggleNetworkRequestStatus(false))
  }
}
