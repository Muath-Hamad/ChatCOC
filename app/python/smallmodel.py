from gensim.models import word2vec
import tensorflow as tf
from keras.preprocessing.text import Tokenizer
from keras_preprocessing.sequence import pad_sequences
from numpy import array
import gensim
from gensim.models import KeyedVectors
import pandas as pd
import numpy as np
import gensim
import re
import spacy
from scipy.spatial.distance import cosine

from datetime import datetime
import gensim
import re
import spacy

load = np.load("./data/model.npy", allow_pickle=True)
Qu = pd.read_excel('./data/Question.xlsx')
df = pd.read_csv('./data/class.csv')
st = pd.read_csv('./data/StudentGPA.csv')

yr = pd.read_excel('./data/year.xlsx')
Qu1 = pd.read_excel('./data/Question2.xlsx')
conflict = pd.read_csv('./data/clPLAN.csv')


model= pd.DataFrame(load)


# Clean/Normalize Arabic Text
def clean_str(text):
    search = ["أ","إ","آ","ة","_","-","/",".","،"," و "," يا ",'"',"ـ","'","ى","\\",'\n', '\t','"','?','؟','!']
    replace = ["ا","ا","ا","ه"," "," ","","",""," و"," يا","","","","ي","",' ', ' ',' ',' ? ',' ؟ ',' ! ']
    
    #remove tashkeel
    p_tashkeel = re.compile(r'[\u0617-\u061A\u064B-\u0652]')
    text = re.sub(p_tashkeel,"", text)
    
    #remove longation
    p_longation = re.compile(r'(.)\1+')
    subst = r"\1\1"
    text = re.sub(p_longation, subst, text)
    
    text = text.replace('وو', 'و')
    text = text.replace('يي', 'ي')
    text = text.replace('اا', 'ا')
    
    for i in range(0, len(search)):
        text = text.replace(search[i], replace[i])
    
    #trim    
    text = text.strip()

    return text
# docs = 
# this Example of Question came from the user it also should include the name of class but this is how it should looks after cleaning 
li = list(df['المقرر'].unique())
target = "وين قاعه  cs181 " 
target = target.upper()
#spliting the sentence into words
for word in li :
    word.upper()
    if word in target:
        searchItem = word
        method = 1
        target = target.replace(word, "")

# if method ==1 :

maxPer = 0
maxSen = []
if searchItem == "":
    for j in range(len(Qu1['سوال'])):
        sen1 = Qu1['سوال'][j].split() #taking only the first Question in the list 'اين قاعة'
        sen2 = target.split()
        wordVec1 = 0
        # finding the first word vectors 
        for i in sen1:
            #cleaning the word
            try:
                word = clean_str(i)
                if word in list(model[0]):
            # adding the vectors of all words
                    wordVec1 += np.array(model[model[0] ==  clean_str(i)][1])[0]
            except:
                print(11)
            # the target vector
        wordVec2 = 0
        for i in sen2:
            try:
                word = clean_str(i)
                if word in list(model[0]):
                    wordVec2 += np.array(model[model[0] ==  clean_str(i)][1])[0]
            except:
                print(11)
        # comapring
        #finding the cosine similarity of the two sentences 
        similarity = 1 - cosine(wordVec1, wordVec2)
        if similarity > maxPer :
            maxPer = similarity
            maxSen = sen1
            seachLoc = j
    
else:
    for j in range(len(Qu['سوال'])):
        sen1 = Qu['سوال'][j].split() #taking only the first Question in the list 'اين قاعة'
        sen2 = target.split()
        wordVec1 = 0
        # finding the first word vectors 
        for i in sen1:
            #cleaning the word
            try:
                word = clean_str(i)
                if word in list(model[0]):
            # adding the vectors of all words
                    wordVec1 += np.array(model[model[0] ==  clean_str(i)][1])[0]
            except:
                print(11)
            # the target vector
        wordVec2 = 0
        for i in sen2:
            try:
                word = clean_str(i)
                if word in list(model[0]):
                    wordVec2 += np.array(model[model[0] ==  clean_str(i)][1])[0]
            except:
                print(11)
        # comapring
        #finding the cosine similarity of the two sentences 
        similarity = 1 - cosine(wordVec1, wordVec2)
        if similarity > maxPer :
            maxPer = similarity
            maxSen = sen1
            seachLoc = j
            
if maxPer >= 0.3:
    if searchItem != '':
        if Qu.loc[seachLoc][1] == 1 :
            for i in range(len(df[df['المقرر'] == searchItem]['الشعبة'])):
                print(f" شعبه {list(df[df['المقرر'] == searchItem]['الشعبة'])[i] } في قاعه رقم {list(df[df['المقرر'] == searchItem]['القاعة'])[i]}")
        #مين يدرس
        elif Qu.loc[seachLoc][1] == 2 :
            print(f"يدرسها {list(df[df['المقرر'] == searchItem]['المحاضر'].unique())}")
        #متى محاضره 
        # متى محاضره 
        elif Qu.loc[seachLoc][1] == 3 :
            for i in range(len(df[df['المقرر'] == searchItem]['الشعبة'])):
                print(f" شعبه {list(df[df['المقرر'] == searchItem]['الشعبة'])[i] } يوم {list(df[df['المقرر'] == searchItem]['الايام'])[i] } تبدا من {list(df[df['المقرر'] == searchItem]['من'])[i]} الى {list(df[df['المقرر'] == searchItem]['الى'])[i]}")
        #متى اختبار
        elif Qu.loc[seachLoc][1] == 4 :
            print(f"  وقت الاختبار في الفتره {list(df[df['المقرر'] == searchItem]['فتره'].unique())}")
        #هل استطيع تنزيل
        elif Qu.loc[seachLoc][1] == 5 :
            for i in range(len(conflict['ماده'])):
                if str(conflict['ماده'][i]) == str(searchItem):
                    if str(conflict['متطلب'][i]) == 'nan':
                        print(" نعم يمكنك تنزيل الماده... لايوجد لها متطلب")
                    elif  str(conflict['متطلب'][i]) in list(st['رمز المقرر']) : 
                            print("نعم يمكنك تنزيل الماده") 
                    else: 
                        print("لا يمكنك")
    else:                
        if Qu1.loc[seachLoc][1] == 7 :
            print(f"يبدا من {str(datetime.strptime(str(yr[yr.columns[1]][0]), '%Y-%m-%d %H:%M:%S').date())  } الى {str(datetime.strptime(str(yr[yr.columns[2]][0]), '%Y-%m-%d %H:%M:%S').date())  }")
        elif Qu1.loc[seachLoc][1] == 8 :
            print(f"يبدا من {str(datetime.strptime(str(yr[yr.columns[1]][1]), '%Y-%m-%d %H:%M:%S').date())  } " )
                # الى {str(datetime.strptime(str(yr[yr.columns[2]][0]), '%Y-%m-%d %H:%M:%S').date())  }")
        elif Qu1.loc[seachLoc][1] == 9 :
            print(f"يبدا من {str(datetime.strptime(str(yr[yr.columns[1]][2]), '%Y-%m-%d %H:%M:%S').date())  } الى {str(datetime.strptime(str(yr[yr.columns[2]][2]), '%Y-%m-%d %H:%M:%S').date())  }")
        
        elif Qu1.loc[seachLoc][1] == 9 :
            print(f"يبدا من {str(datetime.strptime(str(yr[yr.columns[1]][2]), '%Y-%m-%d %H:%M:%S').date())  } الى {str(datetime.strptime(str(yr[yr.columns[2]][2]), '%Y-%m-%d %H:%M:%S').date())  }")
        elif Qu1.loc[seachLoc][1] == 10 :
            x = []
            i = 15 
            while i<30:  
                try :
                    if str(yr[yr.columns[1]][i-2]) != 'NaT':
                
                        x.append(str(datetime.strptime(str(yr[yr.columns[1]][i-2]) , '%Y-%m-%d %H:%M:%S').date()))
                        if str(yr[yr.columns[2]][i-2]) != 'NaT':
                            x.append(str(datetime.strptime(str(yr[yr.columns[2]][i-2]) , '%Y-%m-%d %H:%M:%S').date()))
                except: 
                    break;
                i=i+ 1
            print(f"الاجازات تكون في الايام الاتيه {x}")
        elif Qu1.loc[seachLoc][1] == 11:
            
            print(f"يبدا من {str(datetime.strptime(str(yr[yr.columns[1]][6-2]), '%Y-%m-%d %H:%M:%S').date())  } الى {str(datetime.strptime(str(yr[yr.columns[2]][6-2]), '%Y-%m-%d %H:%M:%S').date())  }")
                
        elif Qu1.loc[seachLoc][1] == 12:
            
            print(f"يبدا من {str(datetime.strptime(str(yr[yr.columns[1]][8-2]), '%Y-%m-%d %H:%M:%S').date())  } الى {str(datetime.strptime(str(yr[yr.columns[2]][8-2]), '%Y-%m-%d %H:%M:%S').date())  }")
else:
    print("الرجاء سؤال سؤال عن الجامعة")
# print(maxPer)
            