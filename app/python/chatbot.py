import sys
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
import gensim
import re
import spacy

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
Qu = pd.read_excel('./data/Question.xlsx')
df = pd.read_csv('./data/class.csv')
st = pd.read_csv('./data/StudentGPA.csv')
conflict = pd.read_csv('./data/clPLAN.csv')


trylist = list(df['المقرر'].unique())
def split_digits_and_words(s):
    result = []
    X = 0
    for c in s:
        if c.isdigit():
            if X ==1 :
                X = 0
                result.append(" ")
            result.append(int(c))
        else:
            result.append(c)
            X = 1

    s = ''.join(str(x) for x in result)

    return s
for i in range(len(trylist)):

    trylist[i] = split_digits_and_words(trylist[i])
count = 0
quList = []
for i in Qu['سوال']:
    for j in trylist:
        a = i + " " + j
        quList.append(a)
        # print(a)
        count+=1
li = list(df['المقرر'].unique())
from scipy.spatial.distance import cosine
import nltk

#Load AraVec
method = 0
model = gensim.models.Word2Vec.load('./data/aravec/wikipedia_cbow_100')
#import Dataset that have synonyms Question about the same thing
# A = pd.read_excel('./data/Question.xlsx')
#converting the Dataframe into list
# docs =
# this Example of Question came from the user it also should include the name of class but this is how it should looks after cleaning

passed=sys.argv[1] # this is a system variable where a JSON will be passed from Laravel

target = passed
target.encode("UTF-8")

# target = " اين مكان القاعه CS451"
#spliting the sentence into words
for word in li :
    if word in target:
        searchItem = word
        method = 1
        target = target.replace(word, "")

if method ==1 :
    maxPer = 0
    maxSen = []
    for j in range(len(Qu['سوال'])):
        sen1 = Qu['سوال'][j].split() #taking only the first Question in the list 'اين قاعة'
        sen2 = target.split()
        wordVec1 = 0
        for i in range(len(sen1)):
            #cleaning the word
            try:
                word = clean_str(sen1[i])
            # adding the vectors of all words
                wordVec1 += model.wv[ word]
            except:
                continue

        wordVec2 = 0
        for i in range(len(sen2)):
            try:
                word = clean_str(sen2[i])
                wordVec2 += model.wv[ word]
            except:
                continue
        #finding the cosine similarity of the two sentences
        similarity = 1 - cosine(wordVec1, wordVec2)
        if similarity > maxPer :
            maxPer = similarity
            maxSen = sen1
            seachLoc = j
        # print(similarity)

    # print( maxSen)
    # print( maxPer)
# elif method == 0:

# if Qu.loc[seachLoc][1] == 1 :
#     # print(f"  وقت الاختبار في الفتره {list(df[df['المقرر'] == searchItem]['فتره'].unique())}")
#     for i in range(len(df[df['المقرر'] == searchItem]['الشعبة'])):
#         print(f" شعبه {list(df[df['المقرر'] == searchItem]['الشعبة'])[i] } في قاعه رقم {list(df[df['المقرر'] == searchItem]['القاعة'])[i]}")
# if Qu.loc[seachLoc][1] == 2 :
#     # print(f"  وقت الاختبار في الفتره {list(df[df['المقرر'] == searchItem]['فتره'].unique())}")
#     print(f"يدرسها {list(df[df['المقرر'] == searchItem]['المحاضر'].unique())}", end=u'', encoding='utf-8')

# if Qu.loc[seachLoc][1] == 3 :
#     # print(f"  وقت الاختبار في الفتره {list(df[df['المقرر'] == searchItem]['فتره'].unique())}")
#     for i in range(len(df[df['المقرر'] == searchItem]['الشعبة'])):
#         print(f" شعبه {df[df['المقرر'] == searchItem]['الشعبة'][i] } تبدا من {df[df['المقرر'] == searchItem]['من'][i]} الى {df[df['المقرر'] == searchItem]['الى'][i]}")
# if Qu.loc[seachLoc][1] == 4 :
#     print(f"  وقت الاختبار في الفتره {list(df[df['المقرر'] == searchItem]['فتره'].unique())}")
# if Qu.loc[seachLoc][1] == 5 :
#         for i in range(len(conflict['ماده'])):
#             if str(conflict['ماده'][i]) == str(searchItem):
#                 if str(conflict['متطلب'][i]) == 'nan':
#                     print(" نعم يمكنك تنزيل الماده... لايوجد لها متطلب")
#                 elif  str(conflict['متطلب'][i]) in list(st['رمز المقرر']) :
#                         print("نعم يمكنك تنزيل الماده")
#                 else:
#                     print("لا يمكنك")


def print_string(string):
    string.encode("UTF-8")
    print(string)

if Qu.loc[seachLoc][1] == 1 :
    for i in range(len(df[df['المقرر'] == searchItem]['الشعبة'])):
        print_string(f" شعبه {list(df[df['المقرر'] == searchItem]['الشعبة'])[i] } في قاعه رقم {list(df[df['المقرر'] == searchItem]['القاعة'])[i]}")
if Qu.loc[seachLoc][1] == 2 :
    print_string(f"يدرسها {list(df[df['المقرر'] == searchItem]['المحاضر'].unique())}", end=u'', encoding='utf-8')

if Qu.loc[seachLoc][1] == 3 :
    for i in range(len(df[df['المقرر'] == searchItem]['الشعبة'])):
        print_string(f" شعبه {df[df['المقرر'] == searchItem]['الشعبة'][i] } تبدا من {df[df['المقرر'] == searchItem]['من'][i]} الى {df[df['المقرر'] == searchItem]['الى'][i]}")
if Qu.loc[seachLoc][1] == 4 :
    print_string(f"  وقت الاختبار في الفتره {list(df[df['المقرر'] == searchItem]['فتره'].unique())}")
if Qu.loc[seachLoc][1] == 5 :
        for i in range(len(conflict['ماده'])):
            if str(conflict['ماده'][i]) == str(searchItem):
                if str(conflict['متطلب'][i]) == 'nan':
                    print_string(" نعم يمكنك تنزيل الماده... لايوجد لها متطلب")
                elif  str(conflict['متطلب'][i]) in list(st['رمز المقرر']) :
                        print_string("نعم يمكنك تنزيل الماده")
                else:
                    print_string("لا يمكنك")




