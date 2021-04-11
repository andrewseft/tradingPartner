import * as types from "./actionsTypes"
import { agent } from "../utils/agent"
import * as API from "../utils/apiPath"
import toggleNetworkRequestStatus from "./toggleNetworkRequestStatus"

export function loadOrderDataSuccess(order) {
  return { type: types.ORDER_DATA_SUCCESS, order }
}

export function loadHoldingDataSuccess(holding) {
  return { type: types.HOLDING_DATA_SUCCESS, holding }
}

export function loadHoldingListDataSuccess(holdingList) {
  return { type: types.HOLDING_DATA_LIST_SUCCESS, holdingList }
}

export const getOrderData = (request) => async (dispatch) => {
  try {
    dispatch(toggleNetworkRequestStatus(true))
    const response = await agent.post(API.ORDER_LIST, request)
    dispatch(toggleNetworkRequestStatus(false))
    dispatch(loadOrderDataSuccess(response.data.data.data))
  } catch (error) {
    dispatch(toggleNetworkRequestStatus(false))
  }
}

export const getHoldingData = (request) => async (dispatch) => {
  try {
    dispatch(toggleNetworkRequestStatus(true))
    const response = await agent.post(API.HOLDING_LIST, request)
    dispatch(toggleNetworkRequestStatus(false))
    dispatch(loadHoldingListDataSuccess(response.data.data))
    dispatch(loadHoldingDataSuccess(response.data.data.data.data))
  } catch (error) {
    dispatch(toggleNetworkRequestStatus(false))
  }
}

export const getPositionData = (request) => async (dispatch) => {
  try {
    dispatch(toggleNetworkRequestStatus(true))
    const response = await agent.post(API.POSITION_LIST, request)
    dispatch(toggleNetworkRequestStatus(false))
    dispatch(loadHoldingListDataSuccess(response.data.data))
    dispatch(loadHoldingDataSuccess(response.data.data.data.data))
  } catch (error) {
    dispatch(toggleNetworkRequestStatus(false))
  }
}
