#include <iostream>
#include <fstream>
#include <unordered_map> 
#include <vector> 
#include <string>
using namespace std;
string s;
vector <string> columns, rows;
unordered_map <string,string> value;

   int doCell(string val)
    {
        char func(' ');
        int answer (0);
        string buffer("");
        int dbuf =-1;
        for (int i = 1;i <= val.size();i++)
        {
            //Проверям знак, является ли он числом
            if (isdigit(val[i]))
            {                
                //Узнаем, является ли эллемент поля числом, либо это продолжение названия ячейки
                if (buffer == "") {
                    if (dbuf == -1) dbuf = 0; // "Инициализируем" переменную нулем.
                    dbuf = dbuf * 10 + (val[i] - '0');
                }
                else
                    buffer = buffer + val[i];
            }
            //Проверям знак, является ли он символом
            if (isalpha(val[i]))
                buffer = buffer + val[i];

            //Если идет оператор
            if (val[i] == '+' or val[i] == '/' or val[i] == '*' or val[i] == '-' or val[i]=='\0')
            {
                if (buffer == "") {
                    if (func == ' ') 
                        answer = dbuf;                    
                }
                else
                {
                    //Если в самом начале выражения находится ссылка, присваиваем ее значение переменной answer
                    if (func == ' ') 
                        answer = stoi(value[buffer]);                                
                }
                //Выполнение арифметической операции
                if (func != ' ') {
                    switch (func) {
                        case '+':
                            if (buffer == "")
                                answer = answer + dbuf;                            
                            if (buffer != "")
                                answer = answer + stoi(value[buffer]);
                            func = '+';
                            break;
                        case '-':
                            if (buffer == "")
                                answer = answer - dbuf;
                            if (buffer != "")
                                answer = answer - stoi(value[buffer]);
                            func = '-';
                            break;
                        case '*':
                            if (buffer == "")
                                answer = answer * dbuf;
                            if (buffer != "")
                                answer = answer * stoi(value[buffer]);
                            func = '*';
                            break;
                        case '/':
                            if (buffer == "")
                                answer = answer / dbuf;
                            if (buffer != "")
                                answer = answer / stoi(value[buffer]);
                            func = '/';
                            break;
                    }
                }
                buffer = "";dbuf = -1; // Сбрасывание буфферных переменных
                switch (val[i]) {
                    case '+':
                        func = '+';
                        break;
                    case '-':
                        func = '-';
                        break;
                    case '*':
                        func = '*';
                        break;
                    case '/':
                        func = '/';
                        break;
                }
            }
        }
        return answer;
    }

int GetNums(string InFile) {
    ifstream input(InFile);
    //Проверка открытия файла
    if (!input) 
        return (-1);
    input >> s;
    string buffer ="";
    // Записываем имена столбцов
    for (int i = 1;i <= s.size();i++)
    {        
        if (s[i] == '\0')
            columns.push_back(buffer);
        if (s[i] != ',') 
            buffer = buffer + s[i];
        else {
            columns.push_back(buffer);
            buffer = "";
        }
    }
    buffer = "";

    int n = 0;
    int b;
    int stopper;
    while (input >> s)
    {         
        b = 0;
        //Поиск и запоминание номера строки
        stopper = s.find(',');
        if (stopper != s.npos) {            
            string m = s.substr(0, stopper);  // Найденный номер строки
            rows.push_back(m);
        }
        //Определение наличия отрицательного числа
        if (s[stopper+1] == '-')
            return -2;     // Возращение числа для дальнейшего вывода ошибки
        //Поиск по строке
        for (int i = stopper+1;i <= s.length();i++)
        {
            if (s[i] == '\0') {
                
                value[columns[b] + rows[n]] = buffer;
                b = 0;
            }
            if (s[i] != ',')
                buffer = buffer + s[i];
            else {
                value[columns[b]+rows[n]] = buffer;
                buffer = "";
                b++;
            }
        }
        buffer = "";
        n++;
    }
  // Выполнение арифмитических операций, если таковые имеются
    for (int i = 0;i < rows.size();i++)
    {
        for (int j = 0;j < columns.size();j++)
        {
            if (value[columns[j] + rows[i]].find('=') != s.npos)
                value[columns[j] + rows[i]] =to_string( doCell(value[columns[j] + rows[i]]));
        }
        cout << endl;
    }
    
}

int main()
{
    if (GetNums("input.csv") == -1)
        cout << "NO INPUT FILE" << endl;

    //ВЫВОД МАТРИЦЫ
    for (int j = 0;j < columns.size();j++)
        cout << columns[j] << ",";
    cout << endl;
    for (int i = 0;i < rows.size();i++)
    {
        cout << rows[i] << ",";
        for (int j = 0;j < columns.size();j++)
        {
            cout << value[columns[j] + rows[i]] << ",";
        }
        cout << endl;
    }
}
