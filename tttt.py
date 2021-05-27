import pandas as pd
import matplotlib.pyplot as plt
import numpy as np
from sklearn import linear_model
# from sklearn.externals import joblib


df=pd.read_csv("data_rain.csv")




cdf=df[['Status','Temperature']]

value=np.random.rand(len(df))<1
train=cdf[value]
test=cdf[~value]


regr=linear_model.LinearRegression()
train_x=np.asanyarray(train[['Temperature']])
train_y=np.asanyarray(train[['Status']])
regr.fit(train_x,train_y)
 


# print(regr.coef_)
# print(regr.intercept_)



df_Test=pd.read_csv("testdata.csv")

df_Test.head()


cdf_Test=df_Test[['Temperature','Status']]



custom_test_x=np.asanyarray(cdf_Test[['Temperature']])
custom_test_y=np.asanyarray(cdf_Test[['Status']])
#print(custom_test_y)
prediction=regr.predict(custom_test_x)

print(prediction[0])

if(prediction[0]<=.5):
        print("Sunny")
else:  
        print("Rainy")      



