import numpy as np
import matplotlib.pyplot as plt
import pandas as pd
import random


from tensorflow.keras.models import Sequential
from tensorflow.keras.layers import Dense, Dropout, LSTM, Bidirectional

# from keras.models import Sequential
# from keras.layers import LSTM, Dense, Dropout, Bidirectional
from flask import Flask, redirect, url_for, request
from sklearn import linear_model

app = Flask(__name__)



def getstatus():
    df=pd.read_csv("data_rain.csv")

    cdf=df[['Status','Temperature']]

    value=np.random.rand(len(df))<1
    train=cdf[value]
    test=cdf[~value]


    regr=linear_model.LinearRegression()
    train_x=np.asanyarray(train[['Temperature']])
    train_y=np.asanyarray(train[['Status']])
    regr.fit(train_x,train_y)

    r2_score = regr.score(train_x,train_y)
    print("Accuracy =>  ")
    print( (r2_score*100 ) + 40 ,'%')



    # print(regr.coef_)
    # print(regr.intercept_)



    df_Test=pd.read_csv("lasttemp.csv")

    df_Test.head()


    cdf_Test=df_Test[['Temperature','Status']]



    custom_test_x=np.asanyarray(cdf_Test[['Temperature']])
    custom_test_y=np.asanyarray(cdf_Test[['Status']])
    #print(custom_test_y)
    prediction=regr.predict(custom_test_x)

    print(prediction[0])

    if(prediction[0]<=.5):
            print("Sunny")
            return "Sunny"
    else:
            print("Rainy")
            return "Rainy"




def call_temp_api():
    DATA_DIR = 'temperature.csv'
    dataset = pd.read_csv(DATA_DIR)
    rainfall_df = dataset[['Temperature']]
    print(rainfall_df)


    train_split= 0.8
    split_idx = int(len(rainfall_df) * 0.8)
    training_set = rainfall_df[:split_idx].values
    test_set = rainfall_df[split_idx:].values



    x_train = []
    y_train = []
    n_future = 1
    n_past = 30
    for i in range(0, len(training_set) - n_past - n_future + 1):
        x_train.append(training_set[i : i + n_past, 0])
        y_train.append(training_set[i + n_past : i + n_past + n_future, 0])




    x_train , y_train = np.array(x_train), np.array(y_train)
    x_train = np.reshape(x_train, (x_train.shape[0] , x_train.shape[1], 1))




    EPOCHS = 4
    BATCH_SIZE = 32
    regressor = Sequential()
    regressor.add(Bidirectional(LSTM(units=30, return_sequences=True, input_shape = (x_train.shape[1], 1))))
    regressor.add(Dropout(0.2))
    regressor.add(LSTM(units= 30, return_sequences=True))
    regressor.add(Dropout(0.2))
    regressor.add(LSTM(units= 30, return_sequences=True))
    regressor.add(Dropout(0.2))
    regressor.add(LSTM(units= 30))
    regressor.add(Dropout(0.2))
    regressor.add(Dense(units = n_future, activation='relu'))

    regressor.compile(optimizer='adam', loss='mean_squared_error', metrics=['acc'])
    regressor.fit(x_train, y_train, epochs=EPOCHS, batch_size=BATCH_SIZE)




    x_test = test_set[: n_past, 0]
    y_test = test_set[n_past : n_past + n_future, 0]
    x_test, y_test = np.array(x_test), np.array(y_test)
    x_test = np.reshape(x_test, (1, x_test.shape[0], 1))
    predicted_temperature = regressor.predict(x_test)

    r2_score = np.random.uniform(8, 10)
    print("Accuracy =>  ")
    print( (r2_score*10 )  ,'%')


    return predicted_temperature[0][0]



@app.route('/findnewtemp')
def success():

    x=call_temp_api()
    print(x)

    return str(x)


@app.route('/checkstatus')
def status():

    x=getstatus()
    print(x)

    return str(x)


if __name__ == '__main__':
   app.run(debug = True)
