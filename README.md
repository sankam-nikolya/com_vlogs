# com_vlogs

### Компонент просмотра сохраненных логов ядра и расширений Joomla

**Возможности**:
– чтение файлов логов и вывод их содержимого в табличном виде в админке
– авторазворачивание json-строки сообщения при просмотре лога в админке
– возможность скачать файл лога в формате CVS (два варианта: классический и специально для открытия в excel без плясок с бубном)
– возможность удалить файл лога

**Требования**:
– Joomla 3.2 и выше (задействован com_ajax)
– PHP 7 и выше (ну ту сами понимаете)

**Минус**: файл лога читается и выводится целиком, если он большой, то это займет время, создаст нагрузку на ресурсы и трафик, поэтому

**Рекомендация разработчикам расширений**: при интенсивном логировании предусмотрите авторазбиение логов на части, по типам задач, по периода, еще как-либо, но чтобы логи ваши не весили мегатонны

<img src="https://image.prntscr.com/image/pbf3-h1UT8G8QvcGtZ3Hbw.png">

О том, как в собственном расширении использовать логирование, можно узнать из документаци Joomla: https://docs.joomla.org/Using_JLog#Logging_a_specific_log_file
